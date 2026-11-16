import { test, expect } from '@playwright/test';
import AxeBuilder from '@axe-core/playwright';

async function logIn(page, email) {
    await page.goto('/inloggen');
    await page.getByLabel('E-mailadres').fill(email + '@dockwerk.test');
    await page.getByLabel('Wachtwoord').fill('dockwerk-demo');
    await page.getByRole('button', { name: 'Inloggen', exact: true }).click({ noWaitAfter: true });
}

test('de homepage is bruikbaar met toetsenbord en op mobiel', async ({ page }) => {
    await page.emulateMedia({ reducedMotion: 'reduce' });
    await page.setViewportSize({ width: 1440, height: 900 });
    const response = await page.goto('/');
    expect(response.status()).toBe(200);
    await expect(page.getByRole('heading', { level: 1 })).toContainText('Service voor bedrijfsdeuren');
    await page.keyboard.press('Tab');
    await expect(page.getByRole('link', { name: 'Naar inhoud' })).toBeFocused();
    await page.keyboard.press('Enter');
    await expect(page.locator('#inhoud')).toBeFocused();
    await expect(page.locator('html')).not.toHaveClass(/lenis/);
    await page.evaluate(() => document.fonts.ready);
    expect(await page.evaluate(() => document.fonts.check('700 20px "Mona Sans"'))).toBe(true);
    expect(await page.locator('.hero-photo').evaluate(image => image.complete && image.naturalWidth > 0)).toBe(true);
    await page.locator('.service-pair').first().scrollIntoViewIfNeeded();
    await expect.poll(() => page.locator('.service-photo').first().evaluate(image => image.complete && image.naturalWidth > 0)).toBe(true);
    expect((await new AxeBuilder({ page }).withTags(['wcag2a', 'wcag2aa', 'wcag21aa']).analyze()).violations).toEqual([]);
    for (const width of [1024, 768, 390, 320, 390]) {
        await page.setViewportSize({ width, height: 844 });
        await expect.poll(() => page.evaluate(() => document.documentElement.scrollWidth)).toBe(width);
    }
    await page.locator('.mobile-menu summary').focus();
    await page.keyboard.press('Enter');
    await expect(page.getByRole('navigation', { name: 'Mobiele navigatie' })).toBeVisible();
    await page.keyboard.press('Escape');
    await expect(page.getByRole('navigation', { name: 'Mobiele navigatie' })).toBeHidden();
    await page.getByRole('link', { name: 'Klantportaal', exact: true }).click();
    await expect(page.getByRole('heading', { name: 'Welkom terug.' })).toBeVisible();
    await page.getByRole('button', { name: 'Noordkade', exact: true }).click();
    await expect(page.getByLabel('E-mailadres')).toHaveValue('noordkade@dockwerk.test');
    await expect(page.getByRole('button', { name: 'Inloggen', exact: true })).toBeFocused();
    expect((await new AxeBuilder({ page }).withTags(['wcag2a', 'wcag2aa', 'wcag21aa']).analyze()).violations).toEqual([]);

    await page.setViewportSize({ width: 1440, height: 900 });
    await page.emulateMedia({ reducedMotion: 'no-preference' });
    await page.goto('/');
    await expect(page.locator('html')).toHaveClass(/lenis/);
    const coverShift = () => page.locator('.cover-picture').evaluate((element) => {
        const transform = getComputedStyle(element).transform;
        return transform === 'none' ? 0 : new DOMMatrix(transform).m42;
    });
    await page.evaluate(() => window.scrollTo(0, 420));
    await expect.poll(coverShift).toBeGreaterThan(24);
    await page.getByRole('link', { name: 'Werkwijze', exact: true }).click();
    await expect(page.locator('.workflow-section')).toBeInViewport();
    expect(await page.locator('.glacier').evaluate((element) => {
        return getComputedStyle(element).position === 'absolute'
            && element.getBoundingClientRect().width === element.parentElement.getBoundingClientRect().width;
    })).toBe(true);
    await page.getByText('Waar vind ik mijn afspraakdatum?', { exact: true }).click();
    await expect(page.getByText('Open de melding vanuit het overzicht.', { exact: false })).toBeVisible();
    await page.emulateMedia({ reducedMotion: 'reduce' });
    await expect.poll(coverShift).toBe(0);
});

test('van melding naar afspraak en afronding met gescheiden bedrijven', async ({ browser }) => {
    const customer = await browser.newContext();
    const staff = await browser.newContext();
    const otherCustomer = await browser.newContext();
    try {
        const client = await customer.newPage();
        const employee = await staff.newPage();
        const other = await otherCustomer.newPage();
        const title = 'Laadpoort valt stil tijdens het openen';

        await logIn(client, 'noordkade');
        await expect(client.getByRole('heading', { name: 'Noordkade Logistiek' })).toBeVisible();
        await client.getByRole('link', { name: 'Nieuwe melding' }).click();
        await client.getByLabel('Bedrijfsdeur').selectOption({ label: 'Laadpoort 3 · Magazijn · Sneek' });
        await client.getByLabel('Onderwerp').fill(title);
        await client.getByLabel('Wat gebeurt er?').fill('De poort stopt halverwege en moet opnieuw worden ingeschakeld.');
        await client.getByRole('button', { name: 'Melding versturen' }).click();
        await expect(client.getByRole('status')).toContainText('Je melding is ontvangen.');
        const detailUrl = client.url();
        expect((await new AxeBuilder({ page: client }).withTags(['wcag2a', 'wcag2aa', 'wcag21aa']).analyze()).violations).toEqual([]);

        await logIn(employee, 'werkplaats');
        await employee.waitForURL('**/werkplaats/meldingen', { waitUntil: 'commit' });
        await expect(employee.getByRole('heading', { name: 'Storingsmeldingen' })).toBeVisible({ timeout: 30_000 });
        await employee.waitForFunction(() => window.Livewire?.all().length > 0, null, { timeout: 45_000 });
        const row = employee.getByRole('row').filter({ hasText: title });
        await row.getByRole('button', { name: 'Bekijken' }).click();
        await expect(employee.getByRole('dialog')).toContainText('De poort stopt halverwege');
        await employee.getByRole('dialog').getByText('Sluiten', { exact: true }).click();
        await row.getByRole('button', { name: 'Inplannen' }).click();
        const future = new Date(Date.now() + 7 * 86_400_000).toISOString().slice(0, 10);
        await employee.getByLabel('Afspraakdatum').fill(future);
        await employee.getByRole('button', { name: 'Afspraak opslaan' }).click();
        await expect(row.getByText('Ingepland', { exact: true })).toBeVisible();
        await client.reload();
        await expect(client.locator('.appointment time')).toHaveAttribute('datetime', future);
        await expect(client.locator('.timeline')).toContainText('Ingepland');

        await row.getByRole('button', { name: 'Afronden', exact: true }).click();
        await employee.getByLabel('Toelichting voor de klant').fill('De aandrijving is afgesteld en getest.');
        await employee.getByRole('button', { name: 'Melding afronden', exact: true }).click();
        await expect(row.getByText('Afgerond', { exact: true })).toBeVisible();
        await client.reload();
        await expect(client.locator('.timeline')).toContainText('De aandrijving is afgesteld en getest.');

        await employee.getByRole('button', { name: 'Filteren', exact: true }).click();
        await employee.getByLabel('Status', { exact: true }).selectOption('scheduled');
        await employee.getByRole('button', { name: 'Filters toepassen', exact: true }).click();
        await expect(row).toHaveCount(0);
        await expect(employee.getByRole('row').filter({ hasText: 'Deur loopt zwaar' })).toBeVisible();

        await logIn(other, 'ijsselhaven');
        await expect(other.getByRole('heading', { name: 'IJsselhaven Opslag' })).toBeVisible();
        await expect(other.getByText(title)).toHaveCount(0);
        expect((await other.goto(detailUrl)).status()).toBe(404);
        expect((await other.goto('/werkplaats/meldingen')).status()).toBe(403);
    } finally {
        await Promise.allSettled([customer.close(), staff.close(), otherCustomer.close()]);
    }
});

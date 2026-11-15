import { defineConfig } from '@playwright/test';

export default defineConfig({
    testDir: './tests/browser',
    workers: 1,
    timeout: 180_000,
    reporter: 'list',
    expect: { timeout: 15_000 },
    use: { baseURL: 'http://127.0.0.1:8766', browserName: 'chromium', actionTimeout: 8000, navigationTimeout: 90000, trace: 'retain-on-failure' },
    webServer: {
        command: 'node tests/browser/serve.mjs',
        url: 'http://127.0.0.1:8766/up',
        reuseExistingServer: false,
        timeout: 45_000,
    },
});

# Werkstatus

Bijgewerkt op 16 november 2026.

- [x] Brief, huisstijl, eigen logo, foto’s en lokaal project vastgelegd.
- [x] Klant kan een eigen deur melden en de status openen.
- [x] Medewerker kan zoeken, filteren, inplannen en afronden.
- [x] Ander bedrijf kan de melding niet bekijken of een deur van een ander bedrijf gebruiken. Een klant heeft geen toegang tot de werkplaats.
- [x] Ontwerp herzien na gebruikersfeedback. [Referenties en bouwbrief](REFERENTIES.md) · [Desktop](screenshots/homepage.png) · [Mobiel](screenshots/homepage-mobiel.png) · [Glacier](screenshots/glacier.png)
- [x] Installatie, demo, architectuur en toolkeuzes opgenomen in de projectdocumentatie.

## Verificatie

| Controle | Uitkomst |
| --- | --- |
| `npm run build` | Vite-build geslaagd. |
| `php vendor/bin/pint --test` | PHP-formattering geslaagd. |
| `php artisan test --compact` | 9 tests, 41 assertions. |
| `npm run test:browser` | 2 Chromium-tests geslaagd. Gecontroleerd bij breedtes 320, 390, 768, 1024 en 1440 px op de homepage. Getest met twee klantaccounts en een medewerker, inclusief afspraak, afronding en geweigerde toegang. |
| `composer setup` in schone kopie | Afhankelijkheden, sleutel, migraties, Filament-assets en Vite-build geslaagd. Seeding en alle PHP-tests slaagden ook in die kopie. |
| axe | Geen overtredingen in de geteste WCAG-regels op de homepage, inlogpagina en meldingsdetails. Toetsenbordfocus en reduced motion zijn in de browser gecontroleerd. |
| `composer validate --no-check-publish`, `composer audit --locked` en `npm audit` | Validatie geslaagd. Op het moment van controle zijn geen bekende kwetsbaarheden gerapporteerd voor de vastgelegde afhankelijkheden. |

De eerste browsercheck bracht een naamclash tussen de eigen Blade-icooncomponent en Filament aan het licht. De component kreeg een projectspecifieke naam. Gebruikersfeedback op de eerste homepage leidde tot een nieuw open raster, nieuw beeld en een afzonderlijk Glacier-vlak. Na onafhankelijke beoordeling zijn het lichte palet in het klantportaal doorgetrokken en het Glacier-vlak op mobiel compacter gemaakt. De browsertest wacht expliciet op de interactieve Livewire-tabel voordat hij acties uitvoert. De statusfilter is ook apart in de lokale demo bediend.

De website is als lokale portfoliodemo gebouwd. `DOCKWERK_DEMO` staat standaard uit in `.env.example`. Hosting voor derden heeft een aparte omgeving nodig.

## Herontwerp van 16 november

- De homepage opent met een beeldvullende avondfoto en een woordmerk onderin. Glacier is een achtergrond van de volledige portaalprocessectie. Twee dienstenblokken, een FAQ en een mobiel menu zijn toegevoegd.
- De bronvergelijking, gebruikte skills, beperkingen van TikTok/X en extra hulpmiddelen staan in [REFERENTIES.md](REFERENTIES.md#tweede-ontwerpstudie--16-november-2026).
- Nieuw bewezen in Chromium: breedtes tot 320 px, menu via toetsenbord en touch, FAQ, fotoverplaatsing van meer dan 24 px in de test en uitgeschakelde parallax bij reduced motion. Pixel 7-emulatie is apart getest met native scroll. De gemeten fotoverplaatsing tijdens de eerste opname was 53 px.
- Vite-build, 9 PHP-tests (41 assertions), Pint en 2 Chromium-tests slaagden. De [MP4](screenshots/dockwerk-motion.mp4) toont circa 10 seconden van de live scroll, Glacier en de FAQ.
- Lighthouse 13.6.0 gaf op de lokale mobiele simulatie toegankelijkheid 100 en best practices 100. De prestatiemeting schommelde in de lokale dev-omgeving. In de geïsoleerde meting was LCP 3,7 s met een trage eerste Laravel-respons en een lange ongespecificeerde taak. Lenis is vervolgens afgesplitst van de animatiebundel voor touch. Een meting op online hosting staat open.
- Na de splitsing slaagde de gerichte homepage-browsertest opnieuw. Het netwerkverkeer in Chromium bevestigt: desktop laadt GSAP en Lenis, touch laadt GSAP, en reduced motion begint met alleen de algemene JavaScript-bundel.

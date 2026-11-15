# Werkstatus

Bijgewerkt op 15 november 2026.

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

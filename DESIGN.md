# Ontwerp van Dockwerk

De homepage is opgebouwd rond een brede avondfoto van een laadperron. Het woordmerk staat onderin het beeld en de kernnavigatie is compact. Daarna volgen twee onderdelen met foto en tekst naast elkaar, het klantportaalproces en een FAQ. De Nederlandse copy beschrijft de taken die daadwerkelijk in het portaal werken.

## Glacier

Glacier is de doorlopende achtergrond van de homepage, het inlogscherm, het klantportaal en de werkplaats. Drie radiale kleurvelden maken een cyaan kern, kobaltblauw links en violet rechts. Een tweede laag van herhaalde lichtnaden verwijst naar de verticale banen in Ahmads referentie. De openingsfoto loopt van schermrand tot schermrand. Daaronder komt Glacier in beeld. Formulieren en tabellen staan op rustigere oppervlakken, zodat ze goed leesbaar blijven.

## Beweging

Vlak na het openen schuift een stalen roldeur omhoog en komt de hele avondfoto in beeld. De roldeur bestaat uit CSS en beweegt mee met de bestaande GSAP-tijdlijn. De foto, tekst en serviceknop zijn direct beschikbaar. Bij scrollen verschuift de foto binnen het kader. In de rest van de homepage schuiven specifieke inhoudsblokken licht in beeld en beweegt de gloed van Glacier mee. Lenis wordt alleen geladen voor precies aanwijzen. Op een aanraakscherm blijft de scroll native. Bij een voorkeur voor minder beweging blijven de animatiebundels bij de eerste weergave buiten de download. Als de voorkeur tijdens het bezoek verandert, past de site de JavaScript-animaties en scrollverzachting aan.

De FAQ en het mobiele menu gebruiken native HTML-disclosures. De foto van het laadperron heeft een afzonderlijke mobiele uitsnede. Mona Sans en de drie gegenereerde projectfoto’s staan lokaal in de app.

Via [de lichtvariant](http://127.0.0.1:8765/?intro=licht) krijgt dezelfde foto een overgang van gedempt naar helder licht en staat het woordmerk gecentreerd boven de serviceknop. Beide openingen gebruiken hetzelfde beeldbestand per schermformaat. [Schermafbeelding van de lichtvariant](docs/screenshots/homepage-licht.png)

[Referenties en werkwijze](docs/REFERENTIES.md) · [Browservideo van de eerdere achtergrond](docs/screenshots/dockwerk-motion.mp4)

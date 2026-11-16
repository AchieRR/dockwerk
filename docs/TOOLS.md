# Tools, skills en referenties

Beoordeeld voor Dockwerk op 15 november 2026. Skills zijn ontwikkelinstructies. Composer- en npm-pakketten zijn de technische afhankelijkheden van de app.

## Gebruikt

| Skill, tool of referentie | Rol in Dockwerk |
| --- | --- |
| `find-skills` | Officiële skill van Vercel Labs gelezen. Met Skills CLI 1.8.1 gezocht op Laravel/Filament en browser­toegankelijkheid. Candidate skills bekeken op herkomst en overlap. [Bron](https://skills.sh/vercel-labs/skills/find-skills) |
| `ponytail` | Het lokale hergebruikprincipe toegepast met Laravel-routes, policies, validatie en Filament. De lokale skill is geschreven voor Break Simulator. Alleen het algemene principe is hergebruikt. |
| `karpathy-guidelines` | Uit de lokale skill de bruikbare regels over expliciete aannames, beperkte scope en meetbare verificatie gebruikt. De oorspronkelijke domeincontext is Break Simulator. |
| `domain-modeling` | Begrippen en regels vastgelegd in [architectuur](ARCHITECTUUR.md). |
| `impeccable` | Ontwerprichtlijnen voor publieke homepage en productoppervlakken gebruikt. Productbrief en vier aangeleverde kleurreferenties lagen al vast. |
| `web-design-guidelines` | Referentie voor semantiek, formulieren, toetsenbordfocus en motion. Geautomatiseerde a11y-controle met axe. [Bron](https://github.com/vercel-labs/agent-skills/blob/main/skills/web-design-guidelines) |
| `sites` | Lokale uitwerking en browserpreview. De app draait op PHP met een lokale database. |
| `awwwards` en `jury` uit `juliobsz/skills` | Geraadpleegd voor art direction, een herkenbare visuele compositie en toetsbare visuele QA. Er is geen externe juryscore aan de site toegekend. [Bron](https://github.com/juliobsz/skills) |
| `gsap-core`, `gsap-performance`, `gsap-scrolltrigger` | Cover-intro, scrollparallax, sectie-entrées en beweging van de Glacier-achtergrond, met transforms en ondersteuning voor reduced motion. [GSAP](https://gsap.com/docs/v3/) |
| `lenis` | Soepel scrollen op de homepage bij een precieze aanwijzer en zonder voorkeur voor minder beweging. [Lenis](https://github.com/darkroomengineering/lenis) |
| `playwright-cli` | De lokale skill gebruikt als referentie voor browsercontrole. De reproduceerbare tests en screenshots gebruiken Playwright Test en Chromium. [Playwright](https://playwright.dev/) |
| `verification-before-completion` | Werkstatus baseren op uitgevoerde build, tests en browsercontrole. |
| RTK | Windows-versie 1.2.0 uit de officiële GitHub-release, SHA-256 gecontroleerd. Gebruikt voor Git-uitvoer. Geïnstalleerd onder `%LOCALAPPDATA%\DockwerkTools`, zonder globale automatisering. [RTK](https://github.com/rtk-ai/rtk/releases/tag/v1.2.0) |
| Obsidian | Documentatie is een lokale Markdown-vault met [Start.md](Start.md) als index. Open `docs` als vault als Obsidian op je pc beschikbaar is. |
| MotionSites | Ontwerpreferentie voor beweging en opbouw van de hero. [MotionSites](https://www.motionsites.ai/) |
| ImageGen en logo | Drie fictieve industriële beelden gegenereerd en lokaal als WebP geleverd. Het Dockwerk-beeldmerk en woordmerk zijn voor dit project gemaakt. |
| Mona Sans | Lokaal geladen variabel lettertype. [Licentie in de repo](../public/fonts/OFL-Mona-Sans.txt). |
| Glacier | Gekozen uit Ahmads vier beeldreferenties. De kleuren #2F6BFF, #6FD3FF, #B9F3FF en #8C7BFF vormen de achtergrond van de volledige sectie over het klantportaal. |
| Pint, Pest, Playwright Test en axe | Aanvullende tools voor PHP-formattering, domeintests, browserflows en geautomatiseerde toegankelijkheidscontroles. |

## Bekeken en uitgesteld

| Skill, tool of referentie | Waarom |
| --- | --- |
| Graphive / Graphify | Graphify is de gevonden codegraaftool. Het is niet bevestigd dat dit hetzelfde product is als het genoemde Graphive. De gekoppelde Markdown-pagina’s hebben hier genoeg structuur. [Graphify](https://github.com/Graphify-Labs/graphify) |
| `react-best-practices`, `composition-patterns`, React Bits | React-specifieke componenten en patronen bewaren we voor een project dat React gebruikt. Dockwerk gebruikt Blade en Filament. [React Bits](https://reactbits.dev/) |
| `gsap-frameworks`, `gsap-react`, `gsap-plugins`, `gsap-timeline`, `gsap-utils` | Als extra GSAP-opties meegenomen. Voor de huidige animaties zijn de core, matchMedia en ScrollTrigger voldoende. |
| `scrapling-official` | De bronnen zijn officiële documentatie en gewone GitHub-pagina’s. Er is geen scraper nodig. [Scrapling](https://github.com/D4Vinci/Scrapling) |
| Recraft | Mogelijke bron voor merkillustraties. Foto’s zijn hier met ImageGen gemaakt en het logo is een eigen vector. [Recraft](https://www.recraft.ai/) |
| Solar Flare, Ultraviolet en Lime Soda | Alle drie meegewogen. Glacier past het best bij de gekozen staal- en ijsblauwe uitstraling. |
| Community-skill `laravel-filament` en Laravel Boost | Aanvullende opties. De app volgt de [officiële Laravel-documentatie](https://laravel.com/docs/13.x) en [Filament-documentatie](https://filamentphp.com/docs/5.x). De actuele pakketcode en echte tests geven hier voldoende bewijs. [Laravel Boost](https://github.com/laravel/boost) |

## Voortgang bewaakbaar houden

De acceptatiecriteria en gecontroleerde commando’s staan in [VOORTGANG.md](VOORTGANG.md). Bij hervatten begint Codex daar en bij de huidige Git-status. Bij een fout leggen we de eerste reproduceerbare oorzaak vast, veranderen we één relevante factor en draaien we de gerichte controle opnieuw. Nieuwe afhankelijkheden krijgen een concrete functie in de demo.

Zie [referentieonderzoek](REFERENTIES.md) voor het herontwerp en de toegepaste Awwwards-criteria.

### Aanvullingen op 16 november

- De Playwright-skill van Currents is gebruikt bij de web-first assertions op beweging en toegankelijke bediening.
- Lighthouse is gebruikt voor een mobiele labmeting en voor controle van contrast tijdens beweging.
- HyperFrames is bekeken als videoworkflow. Playwright en FFmpeg leggen de live scrollbeweging vast. [Onderzoek en bronnen](REFERENTIES.md#tweede-ontwerpstudie--16-november-2026)

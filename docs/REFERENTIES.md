# Referentieonderzoek voor het herontwerp

Gecontroleerd op 15 november 2026. Desktopbeelden van Marby, Witty Wolf, Saad Salman en de Madeline-presentatie zijn in Chromium bekeken. AI-gebruik hieronder komt uit de publicaties van de makers. Reacties zijn voorbeelden van meningen, zonder representatieve steekproef.

| Voorbeeld | Werkwijze volgens de maker | Visuele beoordeling en toepassing |
| --- | --- | --- |
| [Marby live](https://marby.framer.website/) · [Apollo Studio](https://apollostudio.design/work/marby-real-estate-template-ai-built-and-human-tuned) | Eerst type, schaal en beeldrichting bepaald in Figma. Vervolgens in Framer uitgevoerd met externe AI-agents, en handmatig op de live pagina verfijnd. Het exacte promptmateriaal stond niet in de geopende case. [Promptaanbod](https://apollostudio.design/work/get-exclusive-prompt-with-new-framer) | **Hoofdreferentie.** Het gebouw draagt de compositie, met een sobere navigatie en royale ruimte onder de foto. Dockwerk gebruikt een eigen laadperronfoto, een eigen lichtere hero en een losse begeleidende tekst naast de kop. |
| [Witty Wolf](https://wittywolf.design/) · [Case](https://wittywolf.design/work/witty-wolf-site/) | Zelf aangestuurde rebuild in Astro met AI-geschreven code. De case noemt geen exact prompt. | Een herkenbare illustratiestijl, rustige lijnen en redactionele indeling. De decoratieve interactie en twee overlappende panelen zijn voor de dienstverlening van Dockwerk minder geschikt. |
| [Saad Salman](https://saadsalman.org/) · [Bouwverslag](https://saadsalman.org/blog/how-i-built-this-website-with-claude-code) | Claude Code, Next.js en Tailwind. De maker publiceert letterlijk het eerste verzoek om een schone witte aanblik met Apple en Claude als inspiratie. Hij zegt later een geliefd portfolio te hebben gedeeld en Claude creatieve ruimte te hebben gegeven. | De terugkerende betaalillustraties geven de pagina een eigen taal. De overlay, gradientkop en tegelrij maken de eerste weergave druk. |
| [Madeline](https://www.framer.com/marketplace/templates/madeline/) · [Reddit van de maker](https://www.reddit.com/r/framer/comments/1xtmp76/we_built_this_website_in_24_hours_it_won_us_10000/) | Framer Agents-hackathon en een eigen set Framer-skills voor het visuele systeem. Geen volledig prompttranscript in de bekeken bronnen. | De fotocollage is herkenbaar. Een Reddit-reactie vond het open ontwerp goed, maar zag te kleine portretten en UI in de preview. Dockwerk geeft één hoofdbeeld visueel ruimte. |
| [brhpsd.com](https://brhpsd.com/) · [Reddit-discussie](https://www.reddit.com/r/webdesign/comments/1xwmevc/does_my_portfolio_website_look_aigenerated/) | De maker beschrijft eigen Figma-keuzes, vertaald met Claude aan de hand van screenshots per onderdeel en aanwijzingen over maatvoering. | Een reactie noemde het geheel goed maar wees twee herkenbaar generieke onderdelen aan. Een andere vond het eenvoudig en soepel. De reacties laten zien waarom beoordelen per onderdeel nuttig is. |

## Een openbaar promptvoorbeeld

Saad Salman publiceerde zijn eerste zin aan Claude Code: “keep a clean white look, take inspiration from Apple and how Claude designs.” Dat is een startpunt uit zijn verslag. Hij stuurde de details later bij met een visuele referentie en feedback op de werkende pagina. [Bouwverslag](https://saadsalman.org/blog/how-i-built-this-website-with-claude-code)

## Video en bronlimieten

- [YouTube · Claude Code + Seedance 2.5](https://www.youtube.com/watch?v=YUWBku1cNEA). De videovermelding en [beschikbare samenvatting](https://glasp.co/youtube/YUWBku1cNEA) beschrijven Figma, Claude Code en Seedance voor een bouwsite met één scrollgestuurde scène. Het volledige promptlog was niet beschikbaar.
- [YouTube · Design a Fully Animated Website with AI](https://www.youtube.com/watch?v=47geVNoSrz4). De videopagina was beperkt bereikbaar. De [samenvatting](https://learningatlas.us/learning/video/47geVNoSrz4) beschrijft eerst toestanden schetsen in Figma en daarna Claude Code per onderdeel instrueren. De video is niet integraal bekeken.
- TikTok is gezocht. De webindex blokkeerde toegang tot video’s en een directe Chromium-zoekpagina leverde geen verifieerbare videolinks op. Er is daarom geen TikTok-voorbeeld als gecontroleerde referentie gebruikt.

## Gekozen bouwbrief

> Bouw voor Dockwerk een lichte, fotografische homepage met één duidelijke doorgang naar het klantportaal. Begin met een tweekoloms introductie en geef het daadwerkelijke onderwerp, het industriële laadperron, één breed beeldvlak. Beschrijf de storingsflow in drie concrete regels. Plaats ernaast een afzonderlijk Glacier-ontwerpvlak. Gebruik een cyaan kern, kobaltblauw links, violet rechts, dunne lichtnaden en bleke randen. Behoud het rustige raster op mobiel en respecteer reduced motion.

Dit is de bouwbrief voor Dockwerk, geschreven naar aanleiding van de studie. De [awwwwards-skill](https://github.com/juliobsz/skills/tree/add880bd6ec9f5592a1482846fc0dd282c9161bc/awwwards) levert de werkwijze voor één sterke visuele richting, statische compositie en browsercontrole. De Laravel-app en de eigen beelden zijn de implementatiebasis.

## Tweede ontwerpstudie · 16 november 2026

Ahmads schermopname is als contactblad om de acht seconden bekeken. Die steekproef laat zien dat Marby ideeën afwisselt: beeldpanelen, een donkere sectie, een vraag-en-antwoordblok en een eenvoudige menuweergave. Marby is daarna live in Chromium geopend met beweging ingeschakeld en bekeken op circa 0, 400, 840 en 1460 pixels scroll.

| Bron | Concrete observatie en vertaling |
| --- | --- |
| [Marby live](https://marby.framer.website/) · [Apollo Studio](https://apollostudio.design/work/marby-real-estate-template-ai-built-and-human-tuned) | Beeld over de volle breedte, een laag geplaatst merkwoord en veel witruimte rond de volgende fotoblokken. De studio beschrijft Lenis, geleidelijke entrées en scrollsequenties. Dockwerk heeft deze opbouw vertaald naar onderhoud en een eigen foto met een scrollgestuurde verschuiving. |
| [Nova Quinn van Apollo Studio](https://apollostudio.design/work/nova-quinn-a-framer-portfolio-for-visual-artists) | De case beschrijft zorgvuldig geplaatste custom motion-componenten voor een beeldgedreven Framer-site. Geraadpleegd als voorbeeld voor specifieke beeldbeweging per sectie. |
| [Luneo live](https://luneo.framer.website/) · [Feedback op Reddit](https://www.reddit.com/r/framer/comments/1vugq42/looking_for_honest_feedback_on_my_next_framer/) | Live bekeken. Een reactie noemt juist de overgang van een groot openingsbeeld naar een lichte tekstsectie. Gebruikt als compositiereferentie. AI-gebruik is niet vastgesteld. |
| [PortKiller live](https://portkiller.app/) · [Bouwverslag op Reddit](https://www.reddit.com/r/GeminiAI/comments/1pfmv0n/i_vibecoded_a_landing_page_at_a_red_light_with/) | De maker zegt Gemini te hebben gebruikt voor het eerste concept en Claude Code voor uitwerking. De live site koppelt haar animatie aan het eigen onderwerp, een terminal. Voor Dockwerk is het onderwerp een fysieke bedrijfsdeur, dus bewegen foto, woordmerk en lichtbanen in dezelfde rustige richting. |
| [YouTube · Claude Code + Seedance](https://www.youtube.com/watch?v=YUWBku1cNEA) · [YouTube · Figma naar een geanimeerde landing page](https://www.youtube.com/watch?v=wpYJ9gpJ8lM) | De eerste video leverde via de titel en beschikbare samenvatting een voorbeeld van scrollgestuurde beeldregie. De tweede kwam uit de zoekresultaten, maar de videopagina werd beperkt. Deze vermeldingen vormen geen integrale beoordeling van de video's. |

TikTok is via de webzoekopdracht en de publieke browserzoekpagina geprobeerd. De mobiele site gaf een servermelding zonder videolinks. De publieke zoekpagina van X gaf HTTP 403. Van beide platforms is daarom geen post als gecontroleerde visuele bron gebruikt.

### Nieuwe controlehulpmiddelen

- De [motionreferentie van awwwards](https://github.com/juliobsz/skills/blob/add880bd6ec9f5592a1482846fc0dd282c9161bc/awwwards/references/motion.md) is toegepast bij het kiezen van één bewegingslijn voor de hero en spaarzame sectie-entrées. De blog en live site van Marby geven het concrete referentiemateriaal.
- Met [find-skills](https://skills.sh/vercel-labs/skills/find-skills) is gezocht naar GSAP- en browservaardigheden. Uit [Playwright Best Practices van Currents](https://github.com/currents-dev/playwright-best-practices-skill) zijn gerichte locators en web-first assertions gebruikt. In plaats van alleen GSAP te detecteren controleert de test de werkelijke verplaatsing van het beeld, het uitschakelen van de beweging, de achtergrondopbouw en het openen van menu en FAQ.
- [Lighthouse](https://developer.chrome.com/docs/lighthouse/overview) wordt gebruikt als extra controle voor mobiele prestaties en toegankelijkheid. In de eerste ronde maakte aanloopopacity de tekst tijdelijk te licht. De animatie van inhoud gebruikt nu verplaatsing, zodat tekstcontrast behouden blijft.
- HyperFrames en Blender zijn bekeken als mogelijke workflows voor gecomponeerde animatie. De korte preview legt de echte website vast met Playwright en gebruikt FFmpeg voor omzetting naar MP4. GSAP en Lenis verzorgen de live beweging. Voor deze release is een gegenereerde foto in de cover gebruikt, en de video staat bij de documentatie.

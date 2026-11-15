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

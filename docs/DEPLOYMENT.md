# Online demo

Dockwerk is op 23 november 2026 aan Vercel gekoppeld. De publieke website gebruikt de eigen Laravel- en Blade-code in een PHP 8.4-container met FrankenPHP. De PostgreSQL-database staat bij Neon in Frankfurt, op het Free-abonnement. Ahmad heeft het aanmaken van deze database en het accepteren van de Neon-voorwaarden in de chat goedgekeurd.

- Websiteadres voor dit project is https://dockwerk-sable.vercel.app.
- GitHub-repository is https://github.com/AchieRR/dockwerk. De productiebranch in Vercel is `main`.
- De homepage en het interactieve voorbeeld zijn openbaar. Het klantportaal en de werkplaats gebruiken de drie fictieve demoaccounts van de [README](../README.md#demo).
- Vercel Authentication staat voor dit project uit. Controleer de publieke URL na iedere deployment vanuit een browsersessie zonder cookies of bypassheaders.

## Configuratie

`Dockerfile` bouwt de Vite-bestanden en Composer-afhankelijkheden. `docker/Caddyfile` serveert uitsluitend `public`. `docker/start.sh` maakt de tijdelijke Laravel-opslag aan. Bestanden met sleutels, lokale databases en Vercel-accountgegevens worden uitgesloten via `.gitignore`, `.dockerignore` en `.vercelignore`.

De Vercel-omgevingsvariabelen bevatten `APP_KEY`, `APP_URL`, `APP_ENV=preview`, `APP_DEBUG=false`, `DB_CONNECTION=pgsql`, `SESSION_DRIVER=database`, `CACHE_STORE=database` en `DOCKWERK_DEMO=true`. Neon levert `DATABASE_URL`. Laravel gebruikt die URL voor PostgreSQL. Zowel meldingen als sessies en loginlimieten worden in de gedeelde database opgeslagen.

De omgeving `preview` staat uitsluitend fictieve demogegevens toe via de bestaande seeder. Voor een nieuwe database kunnen `php artisan migrate --force` en `php artisan db:seed --force` worden uitgevoerd met de online omgevingsvariabelen. De eerste database is via de Neon HTTP-driver ingericht omdat deze computer geen directe TCP-verbinding naar PostgreSQL kon openen. Het schema is uit de Laravel-migraties gegenereerd. De drie accounts en voorbeeldmeldingen kwamen uit een nieuwe, tijdelijke seeding. Schema en gegevens zijn samen in één PostgreSQL-transactie vastgelegd.

## Opnieuw publiceren

Push wijzigingen naar `main` om de gekoppelde Vercel-build te starten. Een handmatige deployment kan met `npx vercel@latest deploy --prod`. De lokale preview start met `php artisan serve --host=127.0.0.1 --port=8765`.

Vercel CLI kan bij het koppelen een `.env.local` met een OIDC-token aanmaken. Bewaar dat bestand onder `.vercel` als Laravel anders zijn gewone lokale `.env` overslaat. Tokens horen uitsluitend in de genegeerde lokale bestanden en in Vercel.

De configuratie volgt de officiële [PHP-deploymenthandleiding](https://vercel.com/kb/guide/deploy-php-on-vercel-with-docker) en [Container Runtime-documentatie](https://vercel.com/docs/functions/runtimes/container). De instelling voor openbare toegang staat beschreven bij [Deployment Protection](https://vercel.com/docs/deployment-protection).

import { spawn, spawnSync } from 'node:child_process';
import { randomBytes } from 'node:crypto';
import { mkdtempSync, mkdirSync, rmSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';

const workspace = mkdtempSync(join(tmpdir(), 'dockwerk-e2e-'));
const database = join(workspace, 'browser.sqlite');
const compiledViews = join(workspace, 'views');
mkdirSync(compiledViews);
writeFileSync(database, '');
const options = {
    stdio: 'inherit',
    shell: true,
    env: {
        ...process.env,
        APP_ENV: 'testing',
        APP_DEBUG: 'false',
        APP_KEY: 'base64:' + randomBytes(32).toString('base64'),
        APP_URL: 'http://127.0.0.1:8766',
        DB_CONNECTION: 'sqlite',
        DB_DATABASE: database,
        SESSION_DRIVER: 'database',
        CACHE_STORE: 'database',
        VIEW_COMPILED_PATH: compiledViews,
        DOCKWERK_DEMO: 'true',
    },
};
for (const command of ['php artisan migrate --seed --force', 'php artisan view:cache']) {
    const result = spawnSync(command, options);
    if (result.status !== 0) {
        rmSync(workspace, { recursive: true, force: true });
        process.exit(result.status ?? 1);
    }
}

const server = spawn('php artisan serve --host=127.0.0.1 --port=8766 --no-reload', options);
for (const signal of ['SIGINT', 'SIGTERM']) {
    process.on(signal, () => server.kill());
}
server.on('exit', (code) => {
    try {
        rmSync(workspace, { recursive: true, force: true });
    } catch (error) {
        console.error(error.message);
    }
    process.exit(code ?? 0);
});

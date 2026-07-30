<?php
/**
 * ============================================================
 *  AKSO PHARMA — Browser-Executable Artisan Runner
 * ============================================================
 *  Usage: https://yourdomain.com/run.php?token=YOUR_SECRET&cmd=config
 *
 *  ⚠️  SECURITY WARNING:
 *  - Change RUNNER_TOKEN to a secret only you know BEFORE uploading.
 *  - DELETE this file from the server immediately after use.
 *  - Never leave this file on a production server unattended.
 * ============================================================
 */

// ─── CHANGE THIS TO YOUR OWN SECRET TOKEN ─────────────────────────────────────
define('RUNNER_TOKEN', 'REPLACE_THIS_TOKEN');
// ──────────────────────────────────────────────────────────────────────────────

// ─── Security check ──────────────────────────────────────────────────────────
if (!isset($_GET['token']) || $_GET['token'] !== RUNNER_TOKEN) {
    http_response_code(403);
    die('403 Forbidden — Invalid or missing token.');
}

// ─── Bootstrap Laravel ───────────────────────────────────────────────────────
define('LARAVEL_START', microtime(true));

// run.php lives in /public — artisan & vendor are one level up
$basePath = dirname(__DIR__);

require $basePath . '/vendor/autoload.php';

$app = require_once $basePath . '/bootstrap/app.php';

/** @var \Illuminate\Contracts\Console\Kernel $kernel */
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// ─── Available commands ───────────────────────────────────────────────────────
$commands = [
    'migrate'     => ['command' => 'migrate',          'args' => ['--force' => true], 'label' => 'Run database migrations (--force)'],
    'rollback'    => ['command' => 'migrate:rollback',  'args' => ['--force' => true], 'label' => 'Rollback last migration batch'],
    'status'      => ['command' => 'migrate:status',    'args' => [],                  'label' => 'Show migration status'],
    'config'      => ['command' => 'config:cache',      'args' => [],                  'label' => 'Cache configuration files'],
    'config-clear'=> ['command' => 'config:clear',      'args' => [],                  'label' => 'Clear configuration cache'],
    'cache-clear' => ['command' => 'cache:clear',       'args' => [],                  'label' => 'Flush the application cache'],
    'view-clear'  => ['command' => 'view:clear',        'args' => [],                  'label' => 'Clear compiled views'],
    'route-cache' => ['command' => 'route:cache',       'args' => [],                  'label' => 'Cache routes'],
    'optimize'    => ['command' => 'optimize',          'args' => [],                  'label' => 'Cache config, routes & views'],
    'optimize-clear' => ['command' => 'optimize:clear', 'args' => [],                  'label' => 'Clear all caches (config, route, view)'],
    'storage-link'=> ['command' => 'storage:link',      'args' => [],                  'label' => 'Create the storage symlink'],
];

$cmd = $_GET['cmd'] ?? '';
$output = '';
$exitCode = null;
$ran = false;

if ($cmd && isset($commands[$cmd])) {
    ob_start();
    $exitCode = $kernel->call($commands[$cmd]['command'], $commands[$cmd]['args']);
    $output = $kernel->output();
    ob_end_clean();
    $ran = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AKSO PHARMA — Run Tool</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            padding: 24px;
            min-height: 100vh;
        }
        .container { max-width: 860px; margin: 0 auto; }
        header {
            border-bottom: 1px solid #1e293b;
            padding-bottom: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        header h1 { font-size: 1.25rem; color: #4ade80; font-weight: 700; }
        header p { font-size: 0.75rem; color: #64748b; margin-top: 2px; }
        .warning {
            background: #7f1d1d;
            border: 1px solid #dc2626;
            color: #fca5a5;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.8rem;
            margin-bottom: 20px;
        }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 10px; margin-bottom: 28px; }
        .cmd-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 10px;
            padding: 14px 16px;
            text-decoration: none;
            display: block;
            transition: border-color 0.15s, background 0.15s;
        }
        .cmd-card:hover { border-color: #4ade80; background: #1a2e1a; }
        .cmd-card.active { border-color: #4ade80; background: #14532d; }
        .cmd-card code { display: block; color: #86efac; font-size: 0.8rem; font-family: monospace; margin-bottom: 4px; }
        .cmd-card span { color: #94a3b8; font-size: 0.78rem; }
        .output-box {
            background: #0d1117;
            border: 1px solid #21262d;
            border-radius: 10px;
            padding: 20px;
        }
        .output-box h2 {
            font-size: 0.875rem;
            color: #60a5fa;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .badge-ok  { background: #14532d; color: #4ade80; }
        .badge-err { background: #7f1d1d; color: #f87171; }
        pre {
            font-family: monospace;
            font-size: 0.82rem;
            white-space: pre-wrap;
            word-break: break-word;
            color: #d1fae5;
            line-height: 1.6;
        }
        .empty { color: #475569; font-style: italic; }
        footer { margin-top: 32px; font-size: 0.72rem; color: #334155; text-align: center; }
    </style>
</head>
<body>
<div class="container">
    <header>
        <div>
            <h1>⚙ AKSO PHARMA — Run Tool</h1>
            <p>Browser-accessible artisan runner · Token-protected · Delete after use</p>
        </div>
    </header>

    <div class="warning">
        ⚠️ <strong>Security reminder:</strong> Delete this file from the server immediately after you're done. Do not leave it accessible publicly.
    </div>

    <div class="grid">
        <?php foreach ($commands as $key => $def): ?>
        <a href="?token=<?= htmlspecialchars(RUNNER_TOKEN) ?>&cmd=<?= $key ?>"
           class="cmd-card <?= ($cmd === $key) ? 'active' : '' ?>">
            <code>?cmd=<?= $key ?></code>
            <span><?= htmlspecialchars($def['label']) ?></span>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="output-box">
        <?php if ($ran): ?>
            <h2>
                Output: <code style="color:#e2e8f0;font-size:0.85rem"><?= htmlspecialchars($commands[$cmd]['command']) ?></code>
                <span class="badge <?= $exitCode === 0 ? 'badge-ok' : 'badge-err' ?>">
                    <?= $exitCode === 0 ? 'Exit 0 — OK' : "Exit $exitCode — Error" ?>
                </span>
            </h2>
            <pre><?= htmlspecialchars(trim($output) ?: '(no output)') ?></pre>
        <?php else: ?>
            <p class="empty">Click a command above to run it. Output will appear here.</p>
        <?php endif; ?>
    </div>

    <footer>
        AKSO PHARMA NIGERIA LIMITED · run.php · Remember to delete this file after use.
    </footer>
</div>
</body>
</html>

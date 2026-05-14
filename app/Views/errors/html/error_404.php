<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= lang('Errors.pageNotFound') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: #F7F3EF;
            font-family: 'DM Sans', sans-serif;
            color: #6B6360;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .wrap {
            max-width: 520px;
            width: 100%;
            background: #FFFFFF;
            border: 1px solid #EBE5DF;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,.07);
            padding: 3rem 2.5rem;
            text-align: center;
        }

        .error-code {
            font-family: 'Sora', sans-serif;
            font-size: 6rem;
            font-weight: 700;
            color: #C96A2E;
            line-height: 1;
            letter-spacing: -.04em;
            opacity: .15;
            user-select: none;
        }

        h1 {
            font-family: 'Sora', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #1A1714;
            margin-top: 1rem;
            margin-bottom: .5rem;
            letter-spacing: -.01em;
        }

        .message {
            font-size: .9rem;
            color: #6B6360;
            line-height: 1.6;
            margin-top: .75rem;
        }

        code {
            display: inline-block;
            background: #F7F3EF;
            border: 1px solid #EBE5DF;
            color: #C96A2E;
            font-size: .8rem;
            padding: .35rem .85rem;
            border-radius: 6px;
            margin-top: 1rem;
            word-break: break-all;
        }

        .divider {
            border: none;
            border-top: 1px solid #EBE5DF;
            margin: 1.75rem 0;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: #C96A2E;
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-size: .82rem;
            font-weight: 600;
            text-decoration: none;
            padding: .55rem 1.3rem;
            border-radius: 8px;
            transition: background .15s;
        }

        .back-link:hover { background: #b35a23; color: #fff; }

        .footer {
            margin-top: 1.75rem;
            font-size: .75rem;
            color: #A89F9B;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="error-code">404</div>
        <h1>Page Not Found</h1>

        <p class="message">
            <?php if (ENVIRONMENT !== 'production') : ?>
                <code><?= nl2br(esc($message)) ?></code>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </p>

        <hr class="divider">

        <a href="javascript:history.back()" class="back-link">← Go Back</a>

        <p class="footer">If you believe this is a mistake, please contact your administrator.</p>
    </div>
</body>
</html>
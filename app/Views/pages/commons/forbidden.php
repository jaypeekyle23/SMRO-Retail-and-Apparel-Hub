<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --bg:        #F7F3EF;
    --surface:   #FFFFFF;
    --border:    #EBE5DF;
    --accent:    #C96A2E;
    --accent-bg: #FBF0E9;
    --txt:       #1A1714;
    --txt-2:     #6B6360;
    --txt-3:     #A89F9B;
    --danger:    #C0392B;
    --danger-bg: #FDECEA;
    --r:         12px;
    --shadow:    0 2px 12px rgba(0,0,0,.06);
  }

  body, .content-wrapper, main { background: var(--bg) !important; font-family: 'DM Sans', sans-serif; }

  .forbidden-wrap {
    max-width: 560px;
    margin: 4rem auto;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: var(--shadow);
    padding: 3rem 2.5rem;
    text-align: center;
  }

  .error-code {
    font-family: 'Sora', sans-serif;
    font-size: 6rem;
    font-weight: 700;
    color: var(--danger);
    line-height: 1;
    letter-spacing: -.04em;
    opacity: .12;
    user-select: none;
  }

  .accent-bar {
    width: 40px;
    height: 4px;
    background: var(--accent);
    border-radius: 2px;
    margin: 1.25rem auto .75rem;
  }

  h1 {
    font-family: 'Sora', sans-serif;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--txt);
    margin-bottom: .5rem;
    letter-spacing: -.01em;
  }

  .subtitle {
    font-size: .9rem;
    color: var(--txt-2);
    line-height: 1.6;
    margin-bottom: 1.75rem;
  }

  .info-box {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: var(--r);
    padding: 1rem 1.25rem;
    text-align: left;
    margin-bottom: 1.75rem;
  }

  .info-box p {
    font-family: 'Sora', sans-serif;
    font-size: .68rem;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--txt-3);
    margin-bottom: .6rem;
  }

  .info-box ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: .45rem;
  }

  .info-box ul li {
    font-size: .85rem;
    color: var(--txt-2);
    display: flex;
    align-items: flex-start;
    gap: .5rem;
  }

  .info-box ul li::before {
    content: '›';
    color: var(--accent);
    font-weight: 700;
    flex-shrink: 0;
    margin-top: .05rem;
  }

  .divider {
    border: none;
    border-top: 1px solid var(--border);
    margin: 0 0 1.75rem;
  }

  .btn-back {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: var(--accent);
    color: #fff;
    font-family: 'Sora', sans-serif;
    font-size: .82rem;
    font-weight: 600;
    text-decoration: none;
    padding: .55rem 1.3rem;
    border-radius: 8px;
    transition: background .15s;
    border: none;
    cursor: pointer;
  }
  .btn-back:hover { background: #b35a23; color: #fff; }

  .btn-home {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: var(--surface);
    color: var(--txt-2);
    font-family: 'Sora', sans-serif;
    font-size: .82rem;
    font-weight: 500;
    text-decoration: none;
    padding: .55rem 1.3rem;
    border-radius: 8px;
    border: 1px solid var(--border);
    transition: background .15s;
    cursor: pointer;
  }
  .btn-home:hover { background: var(--bg); color: var(--txt); }

  .actions { display: flex; justify-content: center; gap: .75rem; flex-wrap: wrap; }

  .footer-note {
    margin-top: 1.5rem;
    font-size: .75rem;
    color: var(--txt-3);
  }
</style>

<div class="forbidden-wrap">
  <div class="error-code">403</div>

  <div class="accent-bar"></div>

  <h1>Access Denied</h1>
  <p class="subtitle">You don't have permission to view this page. This area is restricted to authorized roles only.</p>

  <div class="info-box">
    <p>This might be because</p>
    <ul>
      <li>Your role doesn't have access to this section</li>
      <li>You're not logged in with the correct account</li>
      <li>The page requires elevated permissions</li>
    </ul>
  </div>

  <hr class="divider">

  <div class="actions">
    <a href="javascript:history.back()" class="btn-back">← Go Back</a>
    <a href="<?= base_url('/') ?>" class="btn-home">🏠 Go to Dashboard</a>
  </div>

  <p class="footer-note">If you believe this is a mistake, contact your administrator to request access.</p>
</div>

<?= $this->endSection(); ?>
<main>
    <div class="container-header">
        <h2>Dashboard</h2>
        <button onclick="drawText()">draw text</button>
    </div>

    <div class="content" id="content">
        <form onsubmit="subscribe(); return false" id="subscribe-form">
            <div class="form-group">
                <label for="">Enter your email to subscribe</label>
                <input type="text" name="email" id="subscribe-email">
            </div>
            <div class="form-group">
                <button class="btn submit">Subscribe</button>
            </div>
        </form>

        <div id="msg">
            Thank you!
            <button class="btn" onclick="resubscribe()">Fill another form</button>
        </div>
    </div>
</main>
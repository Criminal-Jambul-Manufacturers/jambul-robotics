<h2>Parts</h2>
<div class="row">
    <a href="/parts/buildParts"><button type="button">Build Parts</button></a>
    <a href="/parts/buyParts"><button type="button">Buy Parts</button></a>
</div>
<div class="row">
    {part}
    <div class="col-xs-3">
        <a href="/parts/onePart/{partID}">
        <img src="/assets/img/parts/{partImg}" width="50%" height="50%"/></br>
        {partCode} (Cert: {certID})</a>
    </div>
    {/part}
</div>
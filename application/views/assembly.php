<div>
    <h1>Assembly</h1>
    <br/><br/><br/>
</div>
<div class="form-group">
    <nav class="form-group">
        <ul class="form-group">
        <h3>Head</h3>
            <form name="headForm" class="form-group">
                <div align="center">
                    <select name="headDropdown">
                    {head}
                         <option value="{partID}">ID: {partID}  Code: {partCode}</option>
                    {/head}
                    </select>
                </div>
            </form>
            <h3>Torso</h3>
            <form name="torsoForm" class="form-group">
                <div align="center">
                    <select name="torsoDropdown">
                    {torso}
                         <option value="{partID}">ID: {partID}  Code: {partCode}</option>
                    {/torso}
                    </select>
                </div>
            </form>
            <h3>Legs</h3>
            <form name="legsForm" class="form-group">
                <div align="center">
                    <select name="legsDropdown">
                    {legs}
                         <option value="{partID}">ID: {partID}  Code: {partCode}</option>
                    {/legs}
                    </select>
                </div>
            </form>
        </ul>
    </nav>
    <br/> <br/>
</div>
<h2>Robots</h2>
<div class="row">
{robots}
    <h3>Robot {robotID}</h3>
    <div class="col-xs-4">
            <a href="/parts/onePart/{headID}">
            <img src="assets/img/parts/{head}.jpeg" width="50%" height="50%"/></br>
        {head}</a>
    </div>
    <div class="col-xs-4">
            <a href="/parts/onePart/{torsoID}">
            <img src="assets/img/parts/{torso}.jpeg" width="50%" height="50%"/></br>
        {torso}</a>
    </div>
    <div class="col-xs-4">
            <a href="/parts/onePart/{bottomID}">
            <img src="assets/img/parts/{bottom}.jpeg" width="50%" height="50%"/></br>
        {bottom}</a>
    </div>
{/robots}
</div>

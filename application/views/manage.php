<head>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/default.css"/>
</head>
<h2>{pagetitle}</h2>
<div class="row">
    <div>
        <form action="/Manage/register" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="registerName">Name Of Plant</label>
                <div class="col-sm-10">
                    <input type="text" name="registerName" class="form-control" placeholder="Jambul" >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="secret">Secret</label>
                <div class="col-sm-10">
                    <input type="password" name="secret" class="form-control" placeholder="nottelling" >
                </div>
            </div>    
        </form>
        <div class="col-sm-10">
             <button type="submit" class="btn btn-primary" id="registerButton">Register!</button>
        </div>
    </div>
    <div>
        </br></br>
        </br></br>
            <label class="col-sm-10 col-form-label" for="rebootButton" id="rebootLabel">Restart App</label>
            <div class="col-sm-12">
                <button class="btn btn-primary" onclick='reboot()' name="rebootButton" id="rebootButton">REBOOT</button>
            </div>
        </br></br>
        </br></br>
    </div>
    <div>
        <table class="table-responsive">
            <thead>
                <tr>
                    <th class="manageTableCells">Bot ID</th>
                    <th class="manageTableCells">Build Info</th>
                    <th class="manageTableCells">Appearance</th>
                </tr> 
            </thead>
            <tbody>
                {robot}
                <tr>
                    <td>
                        {BOT_ID}
                        Head: {HEAD_ID}
                        Torso: {TORSO_ID}
                        Bottom: {BOTTOM_ID}
                    </td>
                    <td>
                        <img src="/assets/img/parts/{IMG_HEAD}" width="50%" height="50%"/></br>
                        <img src="/assets/img/parts/{IMG_TORSO}" width="50%" height="50%"/></br>
                        <img src="/assets/img/parts/{IMG_BOTTOM}" width="50%" height="50%"/></br>
                    </td>
                    <td>
                        <button class='btn btn-sm' onclick='sellRobot("{BOT_OBJECT}")'>Sell Me!</button>
                    </td>
                </tr>
                {/robot}
            </tbody>
        </table>    
        </br></br>
    </div>
</div>
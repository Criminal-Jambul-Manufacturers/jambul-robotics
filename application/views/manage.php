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
             <button type="submit" class="btn btn-primary">Register!</button>
        </div>
    </div>
    <div>
        <button class="btn btn-primary" onclick='reboot()'>REBOOT</button>
    </div>
    <div>
        <table class="table-responsive">
            <thead>
                <tr>
                    <th>Bot ID</th>
                    <th>Build Info</th>
                    <th>Appearance</th>
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
                        <button class='btn btn-sm' onclick='sellRobot("{BOT_ID}")'>Sell Me!</button>
                    </td>
                </tr>
                {/robot}
            </tbody>
        </table>    
    </div>
</div>
#Change log

Fixed style from Assignment #1:
    Changed Models:
        -Part.php
    Changed Views:
        -assembly.php
        -getPartInfo.php
        -part.php
        -history.php
    Changed controllers:
        -Assembly.php
        -Parts.php
    Changed misc:
        -default.css

Added user roles and selector:
    Changed misc:
         -autoload.php
         -config.php
         -constants.php
    Changed controllers:
        -Assembly.php
        -Roles.php
        -Parts.php
    Changed Views:
        -header.php

Created database and updated models to work with database:
    Changed misc:
     -data/jambul.sql
     -autoload.php
    Changed Models:
        -Part.php
        -Robot.php
        -Transaction.php
        -Config.php
    Changed controllers:
        -Welcome.php
        -Parts.php

Added library with functions for communicating with API:
    Changed library:
        -PandaAPI.php

Added manage page:
    Changed misc:
        -default.css
    Changed Controllers:
        -Manage.php
    Changed Views:
        -manage.php

Added part buying and building to Part page:
    Changed Controllers:
        -Parts.php
    Changed Views:
        -parts.php

Added bot building functionality (Might not work):
    Changed Controllers:
        -Assembly.php
    Changed Views:
        -assembly.php

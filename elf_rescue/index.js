
class Shape {
    objId;
    height;
    width;
    posX;
    posY;
    speed = 0.2;
    constructor(objId, height, width, posX, posY, imageName) {
        this.objId = objId;
        this.height = parseFloat(height);
        this.width = parseFloat(width);
        this.posX = parseFloat(posX);
        this.posY = parseFloat(posY);
        
        var canvas = document.createElement('canvas');

        canvas.id = objId;
        canvas.width = width;
        canvas.height = height;
        canvas.style.marginLeft = posX;
        canvas.style.marginTop = posY;
        canvas.style.zIndex = 1;
        canvas.style.position = "absolute";

        var ctx = canvas.getContext('2d');

        var img = new Image();
        img.onload = function() {
        ctx.drawImage(img, 0, 0);
        };
        img.src = imageName + '.png';

        var background = document.getElementById("background");

        background.appendChild(canvas);
    }

    setCoords(posX, posY) {
        this.posX = posX;
        this.posY = posY;
    }
}


class Bar {
    colour

    constructor (id, colour) {
        this.colour = colour;
        $('#'+id).css({
            'width':642,
            'height':26,
            'z-index':10,
            'position':'relative',
            'background-color': colour,
            'margin':'auto',
            'margin-top': '-8px'
        });
    }
}

class WordValue {
    score = 0;
    lives = 0;
    shield = 0;
    highscore = 0;

    constructor (word, value, posX) {
        this.word = word;
        this.value = value;
        this.posX = posX;

        var div = document.createElement('div');

        div.id = word;
        div.style.width = 80;
        div.style.height = 24;
        div.style.zIndex = 10;
        div.style.position = "absolute";
        div.style.border = "1px solid";
        div.style.borderColor = "black";
        div.style.marginTop = "0px";
        div.style.marginLeft = posX + "px";
        div.style.fontFamily = "sans-serif";
        div.style.textAlign = "center";
        div.style.lineHeight = 1.5;
        div.style.color = "white";

        div.textContent = CapitaliseFirst(word) + ": " + value; 
        
        var bar = document.getElementById("score-bar");
        bar.appendChild(div);
    }

    setValue(word, value) {
        this.value = value;
        $('#'+word).text(CapitaliseFirst(word) + ": " + this.value.toString());
    }

    getValue() {
        return this.value;
    }
}

    function createBlobs() {
        
        for (i = 0; i < numberOfBlobs; i++) {
            randomVariance = Math.floor((Math.random() * varianceNumber) + 1);
            blobArray[i] = new Shape(
                'blob' + i,
                30,
                30,
                -640 + (safetyColumnWidth+(blobColumn*i)+randomVariance),
                -20 -randomVariance*10,
                'blob'
            );
            $('#blob'+i).css({
                'zIndex':-1
            });
        }
    }

    function createTarget() {
        target = new Shape(
            'target',
            30,
            30,
            100,
            -100,
            'target4'
        );

        $('#target').css({
            'margin-top': '100px',
            'margin-left': '-400px'
        });
        target.setCoords(-400, 100);
    }


    function checkCollision()  {
        if (collisionWithBlob == true && !keyStatus.shield) {
            if(lives.getValue() == 1) {
                clearInterval(gameMovement);
                $.post(
                    "saveScore.php",
                    {
                        score : score.getValue(), 
                        username : postData
                    }
                );
                var url = '/login_system/elf_rescue/index.php';
                var form = $('<form action="' + url + '" method="post">' +
                            '<input type="hidden" name="username" value="' + postData + '" />' +
                            '</form>');
                $('body').append(form);
                form.submit();
                // window.location.href = '/login_system/elf_rescue/index.php';
                collisionWithBlob = false;
            } else {
                deathAnniStart();
                manX = -640;
                manY = 0;
                lives.setValue('lives', lives.getValue()-1);
                collisionWithBlob = false;
            }

        }
        if (collisionWithTarget == true) {
            score.setValue('score',score.getValue()+1)
            randomX = -1 *getRandomInt(610);
            randomY = getRandomInt(450);
            $('#target').css({
                'margin-left': randomX+'px',
                'margin-top': randomY+'px'
            });
            target.setCoords(randomX, randomY);
            collisionWithTarget = false;
        }
    }

    function getRandomInt(max) {
        return Math.floor(Math.random() * Math.floor(max));
    }

    function checkForCollisionBetween(objA, objB) {
        let isWithinX = (objB.posX + objB.width) > objA.posX && objB.posX < (objA.posX + objA.width);
        let isWithinY = (objB.posY + objB.height) > objA.posY && objB.posY < (objA.posY + objA.height);
        
        return isWithinX && isWithinY;
    }

    function createDeathAnni() {
        for (i = 0; i < 4; i++) {
            randomVariance = Math.floor((Math.random() * varianceNumber) + 1);
            deathArray[i] = new Shape(
                'death' + i,
                30,
                30,
                -640,
                -20,
                'death' + (i + 1)
            );
            $('#death'+i).css({
                'zIndex':-1
            });
        }

    }

    function setDiv(id, x, y) {
        $(id).css({
            'margin-top': y +'px',
            'margin-left': x +'px'
        });
    }

    function deathAnniStart() {
        for (i = 0; i < 4; i++) {
            setInterval(setDiv('#death'+i,manY,manX), 1000)
        }

    }

    function runMovementAndMoveBlobs() {
        for (i = 0; i < numberOfBlobs; i++) {
            // randomVariance = 
            blobWidth = parseFloat($('#blob'+i).css('width'));
            blobHeight = parseFloat($('#blob'+i).css('height'));
            blobPosX = parseFloat($('#blob'+i).css('margin-left'));
            blobPosY = parseFloat($('#blob'+i).css('margin-top'));
            blobArray[i].setCoords(blobPosX, blobPosY);
            blobPosY += blobSpeed;

            $('#blob'+i).css({
                'margin-top': blobPosY+'px',
                'margin-left': '-' + blobPosX+'px'
            });

            if (blobPosX > maxX) {
                $('#blob'+i).css({
                    'margin-left': Math.floor((Math.random() * varianceNumber) + 1)+'px'
                });
            }

            if (blobPosY > (maxY-blobHeight)) {
                $('#blob'+i).css({
                    'margin-top': -Math.floor((Math.random() * varianceNumber) + 1)*10 +'px',
                    'margin-left': Math.floor(-640 + (safetyColumnWidth+(blobColumn*i)+ (Math.random() *varianceNumber))) +'px'
                });
            }

            collisionWithBlob = checkForCollisionBetween(blobArray[i], man);
            collisionWithTarget = checkForCollisionBetween(target, man);
            checkCollision();
        }

        changeBlobSpeed();

        // LEFT
        if (keyStatus.left){
            manX -=man.speed;
            if (manX < minXLimit){manX = minXLimit;}
            if (manX > manXLimit){manX = manXLimit;}
        }
        
        // RIGHT
        if (keyStatus.right){
            manX +=man.speed;
            if (manX < minXLimit){manX = minXLimit;}
            if (manX > manXLimit){manX = manXLimit;}
        }
        
        // UP
        if (keyStatus.up){
            manY -=man.speed;
            if (manY < minYLimit){manY = minYLimit;}
            if (manY > manYLimit){manY = manYLimit;}
        }
        
        // DOWN
        if (keyStatus.down){
            manY +=man.speed;
            if (manY < minYLimit){manY = minYLimit;}
            if (manY > manYLimit){manY = manYLimit;}
        }

        if (keyStatus.shield) {
            shield.setValue('shield', 1);
            shieldX = manX-5;
            shieldY = manY-5;
        } else {
            shield.setValue('shield', 0);
            shieldX = 0;
            shieldY = -681;
        }

        man.setCoords(manX, manY);

        $('#man').css({'margin-left': manX+'px','margin-top': manY+'px'});

        shield1.setCoords(shieldX,shieldY);

        $('#shield1').css({'margin-left': shieldX+'px','margin-top': shieldY+'px'});

    }

    function CapitaliseFirst(word) {
        return nameCapitalized = word.charAt(0).toUpperCase() + word.slice(1);
    }

    function screenSetup() {

        var html = document.getElementsByTagName("body");
        var background = document.createElement('div');

        background.id = "background";
        background.style.width = 800;
        background.style.height = 0;
        background.style.zIndex = 0;
        background.style.position = "relative";
        background.style.margin = "auto";
        background.style.fontFamily = "sans-serif";
        background.style.textAlign = "center";
        background.style.lineHeight = 1.5;
        background.style.backgroundColor = "white";

        html[0].appendChild(background);
        

        new Bar ('score-bar','green');
        score = new WordValue ('score', 0, 0);
        lives = new WordValue ('lives', 5, 560);
        shield = new WordValue('shield', 0,100);

        var title = document.createElement('div');
        var bar = document.getElementById("score-bar");

        title.id = "name";
        title.style.width = "640";
        title.style.height = 25;
        title.style.zIndex = 10;
        title.style.position = "relative";
        title.style.top = "0px";
        title.style.margin = "auto";
        title.style.fontFamily = "sans-serif";
        title.style.textAlign = "center";
        title.style.lineHeight = 1.5;
        title.style.color = "orange";
        title.textContent = postData;

        bar.appendChild(title);

        var canvas = document.createElement('canvas');

        canvas.id = "matrix";
        canvas.width = 640;
        canvas.height = 480;
        canvas.style.zIndex = 0;
        canvas.style.position = "relative";
        canvas.style.border = "1px solid";
        canvas.style.margin = 'auto';
        canvas.style.marginTop = '-1px';
        
        background.appendChild(canvas);

        // background shapes
        var ctx = canvas.getContext("2d");
        ctx.fillStyle = "rgba(255, 0, 0, 0.2)";
        ctx.fillRect(100, 100, 200, 200);
        ctx.fillStyle = "rgba(0, 255, 0, 0.2)";
        ctx.fillRect(150, 150, 200, 200);
        ctx.fillStyle = "rgba(0, 0, 255, 0.2)";
        ctx.fillRect(200, 50, 200, 200);
        ctx.fillStyle = "rgba(0, 0, 255, 0.2)";
        ctx.fillRect(300, 50, 200, 200);
        ctx.fillStyle = "rgba(0, 230, 64, 1)";
        ctx.fillRect(0, 0, 50, 480);

    }

    function stillDiv(id) {
        $('#'+id).css({
            marginLeft: $('#'+id).css('margin-left'),
            marginTop: $('#'+id).css('margin-top')
        });
    }

    function showBlobPlacementLines() {
        var c = document.getElementById("matrix");
        var ctx = c.getContext("2d");
        ctx.beginPath();
        ctx.moveTo(safetyColumnWidth, 0);
        ctx.lineTo(safetyColumnWidth, 480);
        ctx.stroke();

        for (i = 0; i < numberOfBlobs; i++) {
            var c = document.getElementById("matrix");
            var ctx = c.getContext("2d");
            ctx.beginPath();
            ctx.moveTo(safetyColumnWidth+((i+1)*blobColumn), 0);
            ctx.lineTo(safetyColumnWidth+((i+1)*blobColumn), 480);
            ctx.stroke();
        }
    }

    function movementKeyPresses() {
        keyStatus = {
            up: false,
            down: false,
            left: false,
            right: false,
            shield: false
        };

        window.onkeyup = function(e) {
            e.preventDefault();
    
            if      (e.keyCode === 37) keyStatus.left = false;
            else if (e.keyCode === 38) keyStatus.up = false;
            else if (e.keyCode === 39) keyStatus.right = false;
            else if (e.keyCode === 40) keyStatus.down = false;
            else if (e.keyCode === 101) {
                keyStatus.shield = !keyStatus.shield;
            }

        };
    
        window.onkeydown = function(e) {
            e.preventDefault();
    
            if      (e.keyCode === 37) keyStatus.left = true;
            else if (e.keyCode === 38) keyStatus.up = true; 
            else if (e.keyCode === 39) keyStatus.right = true;
            else if (e.keyCode === 40) keyStatus.down = true;
        };

    }

    //environment
    //blob size, blob type, blob movement
    //man speed, man size, shielded
    //random unmoveable objects

    //Easy things to set first would be speed of blobs

    ///function :ChangeBlodSpeed
    ///Desc : Changes speed of blobs
    /// returns: 
    
    function changeBlobSpeed() {
        if (score.getValue() >= 5  && score.getValue() < 10) {
            blobSpeed = 2;
            
        }

        if (score.getValue() >= 10 && score.getValue() < 15) {
            blobSpeed = 4;
        }

        if (score.getValue() >= 15 && score.getValue() < 20) {
            blobSpeed = 6;
        }
    }

    function main() {

        screenSetup();
        //set dimensions of screen
        $('#heading-box').css({
            display:'none'
        });
        $('#main-box').css({
            display:'none'
        });
        
        maxX=0;
        maxY=480;

        blobArray = [];
        deathArray = [];

        //create player
        man = new Shape('man', 30,30,-641,0, 'man');
        shield1 = new Shape('shield1', 40,40,-681,0, 'sheild2');
        death = 0;
        end = 0;
        numberOfBlobs = 10;
        collisionWithBlob = false;
        intervalSpeed = 10;
        blobSpeed = 1;
        man.speed = 5;
        manWidth = parseFloat($('#man').css('width'));
        manHeight = parseFloat($('#man').css('height'));
        blobWidth = 30;
        blobHeight = 30;
        manXLimit = maxX - manWidth;
        manYLimit = maxY - manHeight;
        minYLimit = 0;
        minXLimit = -641;
        manX = parseFloat($('#man').css('margin-left'));
        manY = parseFloat($('#man').css('margin-top'));
        death = 0;

        safetyColumnWidth = 50;
        totalWidth = 640;
        totalBlobsWidth = totalWidth - safetyColumnWidth;
        blobColumn = totalBlobsWidth / numberOfBlobs;
        varianceNumber = 30;
        randomVariance = Math.floor((Math.random() * varianceNumber) + 1);

        // showBlobPlacementLines();
        createDeathAnni();
        movementKeyPresses();
        createBlobs();
        createTarget();
        gameMovement = setInterval(runMovementAndMoveBlobs, intervalSpeed);

    }
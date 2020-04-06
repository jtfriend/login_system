
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
        canvas.style.zIndex = 8;
        canvas.style.position = "absolute";
        canvas.style.border = "1px solid";

        var ctx = canvas.getContext('2d');

        var img = new Image();
        img.onload = function() {
        ctx.drawImage(img, 0, 0);
        };
        img.src = imageName + '.png';

        var body = document.getElementsByTagName("body")[0];

        body.appendChild(canvas);
    }

    setCoords(posX, posY) {
        this.posX = posX;
        this.posY = posY;
    }
}

// $(document).ready(function(){

    function runMovement() {
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

        if (death == 0) {
            checkCollision();
            man.setCoords(manX, manY);
        } else {
            end = 1;
        }

        
    }
    var blobArray = [];

    function createBlobs() {
        
        for (i = 0; i < numberOfBlobs; i++) {
            randomVariance = Math.floor((Math.random() * varianceNumber) + 1);
            blobArray[i] = new Shape(
                'blob' + i,
                30,
                30,
                safetyColumnWidth+10+blobColumn*i+randomVariance,
                -20 -randomVariance*10,
                'blob'
            );
            $('#blob'+i).css({
                'zIndex':1
            });
        }
    }

    function createTarget() {
        target = new Shape(
            'target',
            30,
            30,
            safetyColumnWidth+10+blobColumn*i+randomVariance,
            -20 -randomVariance*10,
            'target'
        );
    }

    function checkCollision()  {
        if (collision == true) {
            if(lives.getLives() == 1) {
                death = 1;
                collision = false;
            } else {
                manX = 2;
                manY = 25;
                score.setScore('score',score.getScore()+1);
                lives.setLives('lives', lives.getLives()-1);
    
                collision = false;
            }
        } else {
        }
        $('#man').css({'margin-left': manX+'px','margin-top': manY+'px'});
    }

    function getRandomInt(max) {
        return Math.floor(Math.random() * Math.floor(max));
    }

    function checkForCollisionBetween (objA, objB) {
        // console.log(objA.posX+objA.width);
        // console.log(objB.posX);

        collision = (objA, objB) => {
			let isWithinX = (objB.x + objB.width) > objA.x && objB.x < (objA.x + objA.width)
            let isWithinY = (objB.y + objB.height) > objA.y && objB.y < (objA.y + objA.height)
            console.log(isWithinX);
			
			return isWithinX && isWithinY
		}
        // console.log(collision);

        if (
            objA.posX+objA.width >= objB.posX && objA.posX <= objB.posX &&
            objA.posY+objA.height >= objB.posY && objA.posY <= objB.posY
        ||
            objA.posX+objA.width >= objB.posX+objB.width && objA.posX <= objB.posX+objB.width &&
            objA.posY+objA.height >= objB.posY && objA.posY <= objB.posY
        ||
            objA.posX+objA.width >= objB.posX && objA.posX <= objB.posX &&
            objA.posY+objA.height >= objB.posY+objB.height && objA.posY <= objB.posY+objB.height
        ||
            objA.posX+objA.width >= objB.posX+objB.width && objA.posX <= objB.posX+objB.width &&
            objA.posY+objA.height >= objB.posY+objB.height && objA.posY <= objB.posY+objB.height
        ||
            objB.posX+objB.width >= objA.posX && objB.posX <= objA.posX &&
            objB.posY+objB.height >= objA.posY && objB.posY <= objA.posY
        ||
            objB.posX+objB.width >= objA.posX+objA.width && objB.posX <= objA.posX+objA.width &&
            objB.posY+objB.height >= objA.posY && objB.posY <= objA.posY
        ||
            objB.posX+objB.width >= objA.posX && objB.posX <= objA.posX &&
            objB.posY+objB.height >= objA.posY+objA.height && objB.posY <= objA.posY+objA.height
        ||
            objB.posX+objB.width >= objA.posX+objA.width && objB.posX <= objA.posX+objA.width &&
            objB.posY+objB.height >= objA.posY+objA.height && objB.posY <= objA.posY+objA.height
        )
        {
            console.log("collision");
            return true;

        } else {
            console.log("no coll");
            return false;
        }

        if(
                blobPosX+blobWidth >= manX && blobPosX <= manX &&
                blobPosY+blobHeight >= manY && blobPosY <= manY
            ||
                blobPosX+blobWidth >= manX+manWidth && blobPosX <= manX+manWidth &&
                blobPosY+blobHeight >= manY && blobPosY <= manY
            ||
                blobPosX+blobWidth >= manX && blobPosX <= manX &&
                blobPosY+blobHeight >= manY+manHeight && blobPosY <= manY+manHeight
            ||
                blobPosX+blobWidth >= manX+manWidth && blobPosX <= manX+manWidth &&
                blobPosY+blobHeight >= manY+manHeight && blobPosY <= manY+manHeight
            ||
                manX+manWidth >= blobPosX && manX <= blobPosX &&
                manY+manHeight >= blobPosY && manY <= blobPosY
            ||
                manX+manWidth >= blobPosX+blobWidth && manX <= blobPosX+blobWidth &&
                manY+manHeight >= blobPosY && manY <= blobPosY
            ||
                manX+manWidth >= blobPosX && manX <= blobPosX &&
                manY+manHeight >= blobPosY+blobHeight && manY <= blobPosY+blobHeight
            ||
                manX+manWidth >= blobPosX+blobWidth && manX <= blobPosX+blobWidth &&
                manY+manHeight >= blobPosY+blobHeight && manY <= blobPosY+blobHeight
        ) {
            console.log('blah');
        }



 


    }

    function moveBlobs() {

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
                'margin-left': blobPosX+'px'
            });

            if (blobPosX > maxX) {
                $('#blob'+i).css({
                    'margin-left': Math.floor((Math.random() * varianceNumber) + 1)+'px'
                });
            }

            if (blobPosY > maxY) {
                $('#blob'+i).css({
                    'margin-top': -Math.floor((Math.random() * varianceNumber) + 1)*10 +'px'
                });
            }

            // console.log(blobArray[0].posY);
            

            // if (
            //     blobArray[i].posX+blobWidth >= man.posX && blobPosX <= manX &&
            //     blobPosY+blobHeight >= manY && blobPosY <= manY
            // ||
            //     blobPosX+blobWidth >= manX+manWidth && blobPosX <= manX+manWidth &&
            //     blobPosY+blobHeight >= manY && blobPosY <= manY
            // ||
            //     blobPosX+blobWidth >= manX && blobPosX <= manX &&
            //     blobPosY+blobHeight >= manY+manHeight && blobPosY <= manY+manHeight
            // ||
            //     blobPosX+blobWidth >= manX+manWidth && blobPosX <= manX+manWidth &&
            //     blobPosY+blobHeight >= manY+manHeight && blobPosY <= manY+manHeight
            // ||
            //     manX+manWidth >= blobPosX && manX <= blobPosX &&
            //     manY+manHeight >= blobPosY && manY <= blobPosY
            // ||
            //     manX+manWidth >= blobPosX+blobWidth && manX <= blobPosX+blobWidth &&
            //     manY+manHeight >= blobPosY && manY <= blobPosY
            // ||
            //     manX+manWidth >= blobPosX && manX <= blobPosX &&
            //     manY+manHeight >= blobPosY+blobHeight && manY <= blobPosY+blobHeight
            // ||
            //     manX+manWidth >= blobPosX+blobWidth && manX <= blobPosX+blobWidth &&
            //     manY+manHeight >= blobPosY+blobHeight && manY <= blobPosY+blobHeight
            // )
            // {
            //     collision = true;
            // }

            collision = checkForCollisionBetween(blobArray[i], man);
        }

        $('#target').css({
            'margin-top': '100px',
            'margin-left': '100px'
        });

    }

    class Bar {
        colour

        constructor (colour) {
            this.colour = colour;
            $('#score-bar').css({
                'width':642,
                'height':25,
                'z-index':10,
                'position':'absolute',
                'background-color': colour,
                'margin-top': 2,
                'margin-left': 2
            });
        }
    }

    class WordValue {
        score =0;
        lives= 500;
        highscore

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
            // div.style.margin = "10px";
            div.style.marginTop = "0px";
            div.style.marginLeft = posX + "px";
            div.style.fontFamily = "sans-serif";
            div.style.textAlign = "center";
            div.style.lineHeight = 1.5;

            div.textContent = CapitaliseFirst(word) + ": " + value; 
            
            var bar = document.getElementById("score-bar");
            bar.appendChild(div);
        }

        setScore(id, score) {
            this.score = score;
            $('#'+id).text(CapitaliseFirst(id) + ": " + this.score.toString());
        }

        getScore() {
            return this.score;
        }

        setLives(id, lives) {
            this.lives = lives;
            $('#'+id).text(CapitaliseFirst(id) + ": " + this.lives.toString());
        }

        getLives() {
            return this.lives;
        }

    }

    function CapitaliseFirst(word) {
        return nameCapitalized = word.charAt(0).toUpperCase() + word.slice(1);
    }

    function screenSetup() {

        var html = document.getElementsByTagName("body");

        var div = document.createElement('div');

        div.id = "background";
        div.style.width = 800;
        div.style.height = 10;
        div.style.zIndex = 10;
        div.style.position = "absolute";
        div.style.left = "0px";
        div.style.top = "0px";
        div.style.margin = "0px";
        div.style.marginTop = "0px";
        div.style.marginLeft = 0 + "px";
        div.style.fontFamily = "sans-serif";
        div.style.textAlign = "center";
        div.style.lineHeight = 1.5;
        div.style.backgroundColor = "white";

        html[0].appendChild(div);
        

        new Bar ('green');
        score = new WordValue ('score', 0, 0);
        lives = new WordValue ('lives', 2, 560);

        var div = document.createElement('div');
        var bar = document.getElementById("score-bar");

        div.id = "name";
        div.style.width = "640";
        div.style.height = 25;
        div.style.zIndex = 10;
        div.style.position = "absolute";
        div.style.top = "0px";
        div.style.margin = "0px";
        div.style.marginTop = "0px";
        div.style.marginLeft = 0 + "px";
        div.style.fontFamily = "sans-serif";
        div.style.textAlign = "center";
        div.style.lineHeight = 1.5;
        div.style.color = "orange";
        div.textContent = postData;

        bar.appendChild(div);

        

        var canvas = document.createElement('canvas');

        canvas.id = "matrix";
        canvas.width = 640;
        canvas.height = 480;
        canvas.style.zIndex = 0;
        canvas.style.left = "0px";
        canvas.style.top = "0px";
        canvas.style.position = "absolute";
        canvas.style.border = "1px solid";
        canvas.style.marginLeft = "10px";
        canvas.style.marginTop = "35px";
        
        var body = document.getElementsByTagName("body")[0];
        body.appendChild(canvas);

        // background shapes
        var ctx = canvas.getContext("2d");
        ctx.fillStyle = "rgba(255, 0, 0, 0.2)";
        ctx.fillRect(100, 100, 200, 200);
        ctx.fillStyle = "rgba(0, 255, 0, 0.2)";
        ctx.fillRect(150, 150, 200, 200);
        ctx.fillStyle = "rgba(0, 0, 255, 0.2)";
        ctx.fillRect(200, 50, 200, 200);
    }

    function endGame() {
        stillDiv('man');
    }

    function stillDiv(id) {
        $('#'+id).css({
            marginLeft: $('#'+id).css('margin-left'),
            marginTop: $('#'+id).css('margin-top')
        });
    }

    function main() {
        //set dimensions of screen
        $('#heading-box').css({
            display:'none'
        });
        $('#main-box').css({
            display:'none'
        });
        
        maxX=640;
        maxY=480;

        //create player
        man = new Shape('man', 40,40,2,25, 'man');
        death = 0;
        end = 0;
        numberOfBlobs = 8;
        collision = false;
        intervalSpeed = 10;
        blobSpeed = 2;
        man.speed = 5;
        manWidth = parseFloat($('#man').css('width'));
        manHeight = parseFloat($('#man').css('height'));
        manXLimit = maxX - manWidth + 1;
        manYLimit = maxY - manHeight + 26;
        minYLimit = 25;
        minXLimit = 2;
        manX = parseFloat($('#man').css('margin-left'));
        manY = parseFloat($('#man').css('margin-top'));


        safetyColumnWidth = 50;
        totalWidth = maxX;
        totalBlobsWidth = totalWidth - safetyColumnWidth;
        blobColumn = totalBlobsWidth / numberOfBlobs;
        varianceNumber = 30;
        randomVariance = Math.floor((Math.random() * varianceNumber) + 1);


        keyStatus = {
            up: false,
            down: false,
            left: false,
            right: false
        };

        window.onkeyup = function(e) {
            e.preventDefault();
    
            if      (e.keyCode === 37) keyStatus.left = false;
            else if (e.keyCode === 38) keyStatus.up = false;
            else if (e.keyCode === 39) keyStatus.right = false;
            else if (e.keyCode === 40) keyStatus.down = false;
        };
    
        window.onkeydown = function(e) {
            e.preventDefault();
    
            if      (e.keyCode === 37) keyStatus.left = true;
            else if (e.keyCode === 38) keyStatus.up = true; 
            else if (e.keyCode === 39) keyStatus.right = true;
            else if (e.keyCode === 40) keyStatus.down = true;
        };

        setInterval(runMovement,intervalSpeed);
        screenSetup();
        createBlobs();
        createTarget();
        setInterval(moveBlobs, 10);

        if (end == 1) {
            lives.setLives('lives', lives.getLives()-1);
            endGame();
        }
    }



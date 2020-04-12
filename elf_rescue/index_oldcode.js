    //were two setinterval now created one function in one setinterval
        
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
                    'margin-left': Math.floor(-640 + (safetyColumnWidth+blobColumn*i+ (Math.random() *varianceNumber))) +'px'
                });
            }

            collision = checkForCollisionBetween(blobArray[i], man);
            checkCollision();
        }

        $('#target').css({
            'margin-top': '100px',
            'margin-left': '-100px'
        });

    }

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
        
    // setInterval(runMovement,intervalSpeed);
    createBlobs();
    createTarget();
    // setInterval(moveBlobs, intervalSpeed);
    setInterval(runMovementAndmoveBlobs, intervalSpeed);
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.5/gsap.min.js"></script>

    <!-- Bootstrap -->
    <link href="./src/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="./src/js/bootstrapjs/bootstrap.bundle.min.js" type="text/javascript"></script>

    <!-- JQuery -->
    <script src="./src/js/jquery.min.js" type="text/javascript"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- myCSS -->
    <link rel="stylesheet" href="./src/css/style.css">
    <title>MyPage</title>
</head>
<div>
<a class="return" href="/">RETURN</a>
<h1>BBTAN USING VANILLA JAVASCRIPT</h1>
</div>

<body onload="Init()">
    <br/>
    
    <script>
        // Const
        const color = {
            blue: "#0095DD",
            darker_yellow: "#a4b04a",
            black: "#231815",
            white: "white",
            grey: "grey",
            yellow : "#daea64",
            orange : "#f97f68",
            pink : "#f60566",
            transparent : "transparent"
        }

        // Map
        const TileSize = {width : 64, height : 64}
        const MapSize = {width : 5, height : 4}
        const offSet = 12

        // Randomizer
        const PercentBlock = 0.6
        const PercentBonus = 0.25

        // Menu
        const MenuSizeHeight = 64

        // Mouse
        var mousePos
        var mouseDown = false
        var oldMouseDown = false

        // Canvas and setting
        var myGameArea = {
            canvas : document.createElement("canvas"),
            start : function() {
                // Setting up the canvas
                this.canvas.classList.add("GameCanvas");
                this.canvas.width = 350
                this.canvas.height = 622
                this.context = this.canvas.getContext("2d")
                this.context.font = '22px arial'
                document.body.insertBefore(this.canvas, document.body.childNodes[2])

                // Setting up gameLoop
                this.interval = setInterval(Update, 16)
                this.interval = setInterval(Draw, 16)

                // Setting up Mouse variable
                this.canvas.addEventListener("mousemove", function(evt) {
                    var rect = myGameArea.canvas.getBoundingClientRect();
                    mousePos = {x: evt.clientX - rect.left, y: evt.clientY - rect.top}
                })
                this.canvas.addEventListener("mousedown", function(evt) {
                    mouseDown = true
                })
                this.canvas.addEventListener("mouseup", function(evt) {
                    mouseDown = false
                })
            },
            clear : function() {
                this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
            }
        }

        // Game
        var Lost
        
        // Table of Element
        var balls = []
        var blocks = []
        var bonusPlus = []

        // Player
        var player

        // Map
        var currentLevel
        var limitLose

        // Menu
        var score
        var buttonRestart


        function Init() {
            myGameArea.start()
            limitLose = myGameArea.canvas.height - TileSize.height * 3
            buttonRestart = new Button("RESTART", 110, 400, 138, 50, StartGame)
            StartGame()
        }

        function StartGame() {
            // Restart
            balls = []
            blocks = []
            bonusPlus = []

            // Player
            player = new Player(64, 64)

            // Map
            currentLevel=5
            loadMap()

            Lost = false
            score = 0

            // evite que si la souit n'est pas sur l'ecran le jeu bug
            mousePos = {x: player.x, y: player.y}
        }


        function loadMap() {
            // Go throught all the map to create block
            for (var y = 0; y < MapSize.height; y += 1) {
                for (var x = 0; x < MapSize.width; x += 1) {
                    if (Math.random() < PercentBlock) {
                        // Random Health
                        var health=Math.floor(Math.random()*(currentLevel)) + 1
                        blocks.push(new Block(x * TileSize.width + offSet, y * TileSize.height +  offSet + MenuSizeHeight, TileSize.width, TileSize.height, health))
                    } else if (Math.random() < PercentBonus) {
                        bonusPlus.push(new BonusPlus((x + 0.5) * TileSize.width + offSet, (y + 0.5) * TileSize.height +  offSet + MenuSizeHeight, 15))
                    }
                }
            }
        }   


        function Player(pW, pH) {
            // Position and Size
            this.x = (myGameArea.canvas.width - pW)/2
            this.y = myGameArea.canvas.height - pH
            this.nextPosX = 0
            this.w = pW
            this.h = pH

            // Shoot
            this.nbrMaxOfBall = 10
            this.nbrOfBall = 10
            this.isShooting = false
            this.shootingAngle = 0
            this.cooldownShoot = 5
            this.chronoShoot = 5

            this.update = function() {
                // Detect Shoot
                if (mouseDown && mouseDown != oldMouseDown && this.isShooting == false && this.nbrOfBall > 0) {
                    this.isShooting = true
                    // take angle
                    let deltaX = mousePos.x - (this.x + this.w/2)
                    let deltaY = mousePos.y - (this.y + this.h/2)
                    this.shootingAngle = Math.atan2(deltaY, deltaX)
                }

                // Shoot
                if (this.isShooting){
                    this.chronoShoot += 1
                    if (this.chronoShoot > this.cooldownShoot){
                        balls.push(new Ball(this.x + this.w/2, this.y + this.h/2, 10, Math.cos(this.shootingAngle), Math.sin(this.shootingAngle)))
                        this.chronoShoot = 0
                        this.nbrOfBall -= 1
                        if (this.nbrOfBall <= 0) {
                            this.isShooting = false
                        }
                    }
                }
            }

            this.draw = function(ctx) {
                // Line
                if (Lost != true) {
                    ctx.strokeStyle = color.white
                    ctx.beginPath()
                    ctx.textAlign= "center"
                    ctx.textBaseline = "middle"
                    ctx.moveTo(this.x + this.w/2, this.y + this.h/2)
                    ctx.lineTo(mousePos.x, mousePos.y)
                    ctx.stroke()
                }
                

                // Player
                ctx.beginPath()
                ctx.lineWidth = 5
                ctx.fillStyle = color.black
                ctx.strokeStyle = color.pink
                ctx.rect(this.x, this.y, this.w, this.h)
                ctx.fill()
                ctx.stroke()
                ctx.lineWidth = 1
                // nbr balls
                ctx.fillStyle = color.white
                ctx.fillText(this.nbrOfBall, this.x + this.w/2, this.y + this.h/2)
            }
        }


        function Ball(pX, pY, pR, pVx, pVy) {
            // Positon // Size // Velocity
            this.x = pX
            this.y = pY
            this.r = pR
            this.speed = 15
            this.vx = pVx
            this.vy = pVy

            // for delete this object after
            this.remove = false

            this.update = function() {
                // Move
                this.x += this.vx * this.speed
                this.y += this.vy * this.speed

                // Collision on wall
                canvas = myGameArea.canvas
                if (this.x - this.r < offSet) { // Left
                    this.vx = -this.vx
                    this.x = offSet  + this.r
                }
                if (this.x + this.r > canvas.width - offSet) { // Right
                    this.vx = -this.vx
                    this.x = canvas.width - offSet - this.r
                }
                if (this.y - this.r < MenuSizeHeight) { // Top
                    this.vy = -this.vy
                    this.y = MenuSizeHeight  + this.r
                }

                // Delete if under screen
                if (this.y > canvas.height) { // Bot
                    this.remove = true
                }
            }

            this.draw = function(ctx) {
                ctx.strokeStyle = color.white
                ctx.fillStyle = color.white
                ctx.beginPath()
                ctx.arc(this.x, this.y, this.r, 0, 2*Math.PI)
                ctx.fill();
                ctx.stroke()
            }

            this.detectBlock = function(block) {
                // Detect Collision Block
                if (this.x < block.x + block.w && this.x + this.r > block.x && this.y < block.y + block.h && this.r + this.y > block.y) {
                    // Hurt Block
                    block.health-=1
                    score += 1
                    if (block.health<=0){
                        block.remove=true
                    }
                    
                    // Bounce the ball
                    if (this.y - this.r < block.y) { // Top
                        this.vy = -this.vy
                        this.y = block.y - this.r
                    } else if (this.y + this.r > block.y + block.h) { // Bot
                        this.vy = -this.vy
                        this.y = block.y + block.h + this.r
                    }
                    if (this.x + this.r > block.x + block.w) { // Right
                        this.vx = -this.vx
                        this.x = block.x + block.w + this.r
                    } else if (this.x - this.r < block.x) { // Left
                        this.vx = -this.vx
                        this.x = block.x - this.r
                    }
                }
            }

            this.detectBonus = function(bonus) {
                if (Math.sqrt((this.x - bonus.x)**2+(this.y-bonus.y)**2) <= this.r + bonus.r) {
                    bonus.remove = true
                    player.nbrMaxOfBall += 1
                }
            }
        }


        function BonusPlus(pX, pY, pR) {
            // Position and Size
            this.x = pX
            this.y = pY
            this.r = pR

            // for delete this object after
            this.remove = false

            this.draw = function(ctx) {
                ctx.strokeStyle = color.white
                ctx.beginPath()
                ctx.arc(this.x, this.y, this.r, 0, 2*Math.PI)
                ctx.stroke()
                ctx.fillStyle = color.white
                ctx.fillText("+", this.x, this.y)
                ctx.stroke()
            }
        }


        function Block(x,y,w,h,val) {
            // Position and Size
            this.x = x
            this.y = y
            this.w = w
            this.h = h

            // Health
            this.health = val

            // for delete this object after
            this.remove = false

            this.draw = function(ctx) {
                ctx.beginPath()
                // Bacground
                if (this.health<5) {
                    ctx.strokeStyle = color.yellow
                }
                else if (this.health<10) {
                    ctx.strokeStyle = color.orange
                }                
                else if (this.health<15) {
                    ctx.strokeStyle = color.pink
                }
                else if (this.health<30) {
                    ctx.strokeStyle = color.blue
                }
                ctx.fillStyle = color.black
                ctx.lineWidth = 5
                ctx.rect(this.x, this.y, this.w, this.h)
                ctx.fill()

                // health
                ctx.fillStyle = ctx.strokeStyle
                ctx.textAlign = "center"
                ctx.textBaseline = "middle"
                ctx.fillText(this.health, this.x + this.w/2, this.y + this.h/2)
                ctx.stroke()
                ctx.lineWidth = 3
            }
        }


        function Update() {
            // While not Lost
            if (Lost==false){
                // Update Ball and Collsion with block and bonus
                balls.forEach(ball => {
                    ball.update()
                    blocks.forEach(block => {ball.detectBlock(block)})
                    bonusPlus.forEach(bonus => {ball.detectBonus(bonus)})
                })

                // Update Player
                player.update()

                // End of turn
                if (balls.length == 0 && player.nbrOfBall == 0) {
                    // Reset Player Pos with the limit of map (offset) and balls
                    player.x = player.nextPosX
                    if (player.x < offSet) { // Left
                        player.x = offSet
                    }
                    if (player.x > myGameArea.canvas.width - player.w-offSet) { // Right
                        player.x = myGameArea.canvas.width - player.w-offSet
                    }
                    player.nbrOfBall = player.nbrMaxOfBall

                    // Make block go down
                    for (var i = 0; i < blocks.length; i += 1) {
                        blocks[i].y += TileSize.height

                        // If block out, lose
                        if (blocks[i].y > limitLose) {
                            Lost = true
                        }
                    }

                    // Make bonus go down
                    for (var i = 0; i < bonusPlus.length; i += 1) {
                        bonusPlus[i].y += 68
                    }

                    // Add Difficulty and add a row
                    currentLevel+=1
                    for (var x = 0; x < MapSize.width; x += 1) {
                        if (Math.random() < PercentBlock) {
                            // Random Health
                            var health=Math.floor(Math.random()*(currentLevel/2)) + Math.floor(currentLevel/2)
                            blocks.push(new Block(x * TileSize.width + offSet, offSet + MenuSizeHeight, TileSize.width, TileSize.height, health))
                        } else if (Math.random() < PercentBonus) {
                            bonusPlus.push(new BonusPlus((x + 0.5) * TileSize.width + offSet, 0.5 * TileSize.height + offSet + MenuSizeHeight, 15))
                        }
                    }
                }
                
                // Remove necessary item
                balls = balls.filter(function(val, ind, arr) {
                    player.nextPosX = val.x
                    return val.remove != true
                })
                blocks = blocks.filter(function(val, ind, arr) {
                    return val.remove != true
                })
                bonusPlus = bonusPlus.filter(function(val, ind, arr) {
                    return val.remove != true
                })
            } else {
                buttonRestart.update()
            }

            // For detection of the button
            oldMouseDown = mouseDown
        }


        function Button(pText, pX, pY, pW, pH, pAction, pColor = color.yellow, pColorHover = color.darker_yellow, pTextColor = color.white) {
            // Position and Size
            this.x = pX
            this.y = pY
            this.w = pW
            this.h = pH

            // Color
            this.color = pColor
            this.colorText = pTextColor
            this.colorHover = pColorHover

            // Text
            this.text = pText

            // function
            this.action = pAction

            this.update = function() {
                if (this.x < mousePos.x && mousePos.x < this.x + this.w && this.y < mousePos.y && mousePos.y < this.y + this.h && mouseDown && oldMouseDown != mouseDown) { 
                    this.action()
                }
            }

            this.draw = function(ctx) {
                // Background
                ctx.fillStyle = color.black
                // If hover
                if (this.x < mousePos.x && mousePos.x < this.x + this.w && this.y < mousePos.y && mousePos.y < this.y + this.h) {
                    ctx.strokeStyle = this.colorHover
                } else {
                    ctx.strokeStyle = this.color
                }
                ctx.rect(this.x, this.y, this.w, this.h)
                ctx.fill()
                ctx.stroke()
                // Draw Text
                ctx.fillStyle = this.colorText
                ctx.beginPath()
                ctx.textAlign = "center"
                ctx.textBaseline = "middle"
                ctx.fillText(this.text, this.x + this.w/2, this.y + this.h/2)
                ctx.stroke()
            }
        }


        function Draw() {
            // Clear screen
            myGameArea.clear()
            ctx = myGameArea.context

            // Draw Ball
            balls.forEach(ball => {ball.draw(ctx)})

            // Draw Player
            player.draw(ctx)

            // Draw Element Map
            blocks.forEach(block => {block.draw(ctx)})
            bonusPlus.forEach(item => {item.draw(ctx)})

            // Menu
            ctx.beginPath()
            ctx.strokeStyle = color.white
            ctx.fillStyle = color.transparent
            ctx.rect(0, 0, myGameArea.canvas.width, MenuSizeHeight)
            ctx.fill()
            ctx.fillStyle = color.white
            ctx.textAlign = "center"
            ctx.textBaseline = "middle"
            ctx.font = "22px 'sweet'"
            ctx.fillText("SCORE : " + score, myGameArea.canvas.width - myGameArea.canvas.width/2, 35)
            ctx.stroke()

            if (Lost) { // Draw gameover screen
                // Background
                ctx.strokeStyle = color.white
                ctx.fillStyle = color.black
                ctx.rect(33, 120, 290, 400)
                ctx.fill()
                ctx.stroke()
                // Text
                ctx.beginPath()

                ctx.fillStyle = color.white
                ctx.textAlign = "center"
                // Lose
                ctx.font = "30px 'sweet'"
                ctx.fillText("YOU LOSE !", 178, 225)

                // Score
                ctx.font = "22px 'sweet'"
                ctx.fillText("SCORE : " + score, 178, 325)

                // Button
                buttonRestart.draw(ctx)

                ctx.stroke()
            }
        }

    </script>
    <!-- Main -->
    <main>

        <div id="particles-js">
            <div class="container">
                
                
            
            </div>
        </div>

    </main>
    
    <!-- Footer -->
    <?php require "./src/Module/footer.php" ?>

    <!-- JS Scripts -->
    <script src="./src/js/fadein.js"></script>
    <script src="./src/js/particles/particles.js"></script>
    <script src="./src/js/particles/Portfolio.js"></script>
    <script src="./src/js/buttonslide.js"></script>
    


    <style>
        body{
            font-family:"sweet","Varela_Round";
        }
        canvas {
            display: flex;
            margin: auto;
        }
        .GameCanvas{
            width: 350px;
            height: auto;
            background-image: url('./src/img/BBTAN Background.jpg');
            position: static;
            border: 4px solid #a4b04a;
            
        }
        .particles-js-canvas-el{
            
        }
        h1{
            margin: 30px auto !important;
            font-size: 40px;
            width: 350px;
            text-align: center;
            color: #a4b04a;
        }
    </style>
</body>
</html>
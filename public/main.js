var main, content;
var CanvasWitdh;
var BgSound;
var gambar, pesawat, laser, batu;
var PesawatX, PesawatY;
var laserX, laserY;
var batuX, batuY;
var LaserArray = [];
var BatuArray = [];
var TimeGame, TimeBatu;
var kalah;
var score = 0;
var scoreTertinggi = 100;

function mulai() {
    Controller();
    TimeGame = setInterval(() => {
        perpindahan();
    }, 100);

    TimeBatu = setInterval(() => {
        inserBatu();
    }, 2000);
    BgSound.play();

    document.getElementById("myCanvas").removeEventListener("click", mulai);
}


document.getElementById("myCanvas").addEventListener("click", mulai);




window.onload = function () {
    main = document.getElementById("myCanvas");
    content = main.getContext("2d");

    //Ambil data user now
    fetch("http://games.test/score/get",)
        .then((response) => response.json())
        .then((result) => {
            scoreTertinggi = result.score;
        })
        .catch((error) => {
            console.error("Error:", error);
        });

    //Tampilan Background
    gambar = new Image();
    gambar.src = "./img/bg.png";
    gambar.onload = () => {
        content.drawImage(gambar, 0, 0, main.width, main.height);
    }



    pesawat = new Image();
    pesawat.src = "./img/pesawat.png";
    pesawat.onload = () => {
        PesawatX = 0;
        PesawatY = main.height - 100;
        content.drawImage(pesawat, PesawatX, PesawatY, 100, 100);
    }


    laser = new Image();
    laser.src = "./img/laser.png";
    laser.onload = () => {
        laserX = 20;
        laserY = main.height - 100;
        content.drawImage(laser, laserX, laserY, 100, 100);
    }

    batu = new Image();
    batu.src = "./img/Batu.png";
    batu.onload = () => {
        batuX = 20;
        batuY = main.height - 100;
        content.drawImage(batu, batuX, batuY, 100, 100);
    }


    var awal = new Image();
    awal.src = "./img/awal.png";
    awal.onload = () => {
        content.drawImage(awal, 0, 0, main.width, main.height);
    }

    kalah = new Image();
    kalah.src = "./img/kalah.png";

    setTimeout(() => {
        BgSound = new Audio;
        BgSound.src = "./audio/atmosphere.wav";
        BgSound.volume = 0.1;
        BgSound.loop = true;
    }, 1000);

};



function perpindahan() {
    content.drawImage(gambar, 0, 0, main.width, main.height);
    content.drawImage(pesawat, PesawatX, PesawatY, 100, 100);
    LaserGerak();
    gerakBatu();
    content.font = "20px Comic Sans MS";
    content.fillStyle = "white";
    content.textAlign = "center";
    content.fillText(score, 40, 40);
    content.fillText("Score Tertinggi " + scoreTertinggi, main.width / 2, 40);
}

function pesawtController(status) {
    if (status == "kanan") {
        PesawatX += 100;
        if (PesawatX > main.width - 100) {
            PesawatX = main.width - 100;
        }
    } else if (status == "kiri") {
        PesawatX -= 100;
        if (PesawatX < 0) {
            PesawatX = 0;
        }
    }

}


function playLaser() {

    var laserAudio = new Audio;
    laserAudio.src = "./audio/laser.wav";
    laserAudio.play();
    LaserArray.push({
        y: laserY,
        x: PesawatX,
        s: false
    });
    // console.log(LaserArray[0].x);

    // content.drawImage(laser, PesawatX, laserY, 100, 100);

}


function LaserGerak() {
    jumlahPeluru = LaserArray.filter((val) => val.y > 0 && val.s == false);
    jumlahPeluru.forEach(val => {
        val.y -= 10;
        // BatuArray.filter((data) => data.y == val.y && data.x == val.x );
        // BatuArray.forEach(element => {
        //   element = true;
        //   val.s = true;
        // });

        // if (BatuArray[0].y){
        //   if (val.y == BatuArray[0].y ){
        //     console.log("laser " + val.y);
        //     console.log("batu " + BatuArray[0].y);
        //   }
        // }

        BatuArray.map(elem => {
            if (elem.y >= val.y - 90 && elem.x == val.x && elem.s == false) {
                elem.s = true;
                val.s = true;
                score += 1;
            }
            return elem;
        });

        content.drawImage(laser, val.x, val.y, 100, 100);
    });
    // console.log(LaserArray[0].y);
}

function Controller() {
    window.addEventListener("keydown", (e) => {
        e.preventDefault();
        if (e.key == "ArrowLeft") {
            pesawtController("kiri");
        } else if (e.key == "ArrowRight") {
            pesawtController("kanan");
        } else if (e.code == "Space") {
            playLaser();
        }
    })
}

function inserBatu() {
    BatuArray.push({
        y: 0,
        x: Math.floor(Math.random() * 6) * 100,
        // x: 0,
        s: false
    });
}


function gerakBatu() {
    jumlahBatu = BatuArray.filter((val) => val.s == false);

    jumlahBatu.forEach(val => {
        val.y += 10;
        if (val.y > 500) {
            val.y = 500;
            var kalahAUdio = new Audio;
            kalahAUdio.src = "./audio/kalah.wav";
            kalahAUdio.volume = 0.4;
            kalahAUdio.play();
            clearInterval(TimeBatu);
            clearInterval(TimeGame);
            setTimeout(() => {
                content.drawImage(kalah, 0, 0, main.width, main.height);
                document.getElementById("myCanvas").onclick = () => {
                    window.location.reload();
                };

            }, 100);
            BgSound.volume = 0;
            fetch("http://games.test/score/update?score=" + score,)
                .then((response) => response.json())
                .then((result) => {
                    console.log(result);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });

        }
        content.drawImage(batu, val.x, val.y, 100, 100);
    })

}

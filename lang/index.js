function loop() {
    $('#welcome').fadeOut(500)
    setTimeout(function () {
        document.getElementById('welcome').innerHTML = "Welcome!"
        $('#welcome').fadeIn(500)
        setTimeout(function () {
            $('#welcome').fadeOut(500)
            setTimeout(function () {
                document.getElementById('welcome').innerHTML = "Bienvenue !"
                $('#welcome').fadeIn(500)
                setTimeout(function () {
                    $('#welcome').fadeOut(500)
                    setTimeout(function () {
                        $('#welcome').fadeOut(500)
                        setTimeout(function () {
                            document.getElementById('welcome').innerHTML = "¡Bievenido!"
                            $('#welcome').fadeIn(500)
                            setTimeout(function () {
                                $('#welcome').fadeOut(500)
                                setTimeout(function () {
                                    $('#welcome').fadeOut(500)
                                    setTimeout(function () {
                                        document.getElementById('welcome').innerHTML = "Benvenuto!"
                                        $('#welcome').fadeIn(500)
                                        setTimeout(function () {
                                            $('#welcome').fadeOut(500)
                                    setTimeout(function () {
                                        document.getElementById('welcome').innerHTML = "Herzlich willkommen!"
                                        $('#welcome').fadeIn(500)
                                        setTimeout(function () {
                                            $('#welcome').fadeOut(500)
                                            setTimeout(function () {
                                                document.getElementById('welcome').innerHTML = "Добро пожаловать!"
                                                $('#welcome').fadeIn(500)
                                                setTimeout(function () {
                                                    $('#welcome').fadeOut(500)
                                                    setTimeout(function () {
                                                        document.getElementById('welcome').innerHTML = "欢迎您！"
                                                        $('#welcome').fadeIn(500)
                                                        setTimeout(function () {
                                                            $('#welcome').fadeOut(500)
                                                            setTimeout(function () {
                                                                document.getElementById('welcome').innerHTML = "ようこそ！"
                                                                $('#welcome').fadeIn(500)
                                                                // setTimeout(function () {
                                                                    setTimeout(function () {
                                                                        $('#welcome').fadeOut(500)
                                                                        setTimeout(function () {
                                                                            document.getElementById('welcome').innerHTML = "PinPages"
                                                                            $('#welcome').fadeIn(500)
                                                                            setTimeout(function () {
                                                                                loop()
                                                                            }, 500)
                                                                        }, 500)
                                                                    }, 500)
                                                                // }, 500)
                                                            }, 500)
                                                        }, 500)
                                                    }, 500)
                                                }, 500)
                                            }, 500)
                                        }, 500)
                                    }, 500)
                                        }, 500)
                                    }, 500)
                                }, 500)
                            }, 500)
                        }, 500)
                    }, 500)
                }, 500)
            }, 500)
        }, 500)
    }, 500)
}

loop()
$(() => {
    document.getElementById("access-form").addEventListener("submit", (e) => {
         e.preventDefault();
         
        let data = document.getElementById("access-form")

        data = new FormData(data)

        const params = {
            body: data,
            method: "POST"
        }

        fetch('models/auth-model.php',params)
            .then(response => response.json())
            .then( data => {
                if (data.response == "Ok") {
                    Swal.fire(
                        'Registro exitoso',
                        data.message,
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Error',
                        data.message,
                        'error'
                    )
                }
            })
    })
} )


$(() => {
    document.getElementById("register-form").addEventListener("submit", (e) => {
         e.preventDefault();
         
        let data = document.getElementById("register-form")

        data = new FormData(data)

        const params = {
            body: data,
            method: "POST"
        }

        fetch('models/auth-model.php',params)
            .then(response => response.json())
            .then( data => {
                if (data.response == "Ok") {
                    Swal.fire(
                        'Registro exitoso',
                        data.message,
                        'success'
                    )
                }
            })
        // const values = []

        // for (const [name, value] of a) {
        //     values.push({ name, value })
        // }


        // console.log(values)

    })
} )

$(() => {
    document.getElementById("forgot-form").addEventListener("submit", (e) => {
        e.preventDefault();

        let data = document.getElementById("forgot-form")

        data = new FormData(data)

        const params = {
            body: data,
            method: "POST"
        }

        fetch('models/auth-model.php', params)
            .then(response => response.json())
            .then(data => {
                if (data.response == "Ok") {
                    Swal.fire(
                        'Registro exitoso',
                        data.message,
                        'success'
                    )
                    setTimeout(() => {
                        window.location.href = data.url
                    },2000)
                } else {
                    Swal.fire(
                        'Error',
                        data.message,
                        'error'
                    )
                }
            })
    })
})
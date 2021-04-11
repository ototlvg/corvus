<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        .boton{
            width: 150px;
            height: 55px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            background-color: white;
        }

        .boton:hover{
            color: white;
            background-color: orange;
        }

        .boton.active{
            background-color: orange;
            color: white;
        }

        .w-special{
            width: 54% !important;
        }

        body{
            background-color: #f2f2f0 !important;
        }



    </style>
</head>
<body>
    {{-- <p>{{$type}}</p> --}}

    <div id="app" class="d-flex w-100 justify-content-center align-items-center" style="height: 100vh">
        
        <div class="d-flex w-50 flex-wrap">

            <div class="header w-100 d-flex justify-content-center p-5 align-items-center">
                <p class="m-0">{{$obj->question}}</p>
            </div>

            <div class="body w-100">
                <form id="form" action="{{route('initialQuestionStore')}}" method="post" class="w-100 d-flex justify-content-center flex-wrap">
                    @csrf

                    <div class="d-flex justify-content-between w-special" id="eventContainer">
                        <div id="btn-true" class="boton border">
                            {{-- <p class="m-0">Si</p> --}}
                            Si
                        </div>

                        <div id="btn-false" class="boton border">
                            No
                        </div>
                    </div>
                    
                    <div class="d-none">
                        <input id="radio-true" class="form-check-input" type="radio" id="positive" name="question" value="1">
                        <label class="form-check-label" for="positive">Si</label><br>
                
                        <input id="radio-false" class="form-check-input" type="radio" id="negative" name="question" value="0">
                        <label class="form-check-label" for="negative">No</label><br>
                        
                        <input type="text" name="type" id="type" value="{{$obj->type}}" class="d-none">
                    </div>
            
                    <div class="d-flex w-100 mt-5 d-flex justify-content-center">
                        {{-- <input type="submit" value="Guardar" class="btn btn-primary"> --}}
                        <button type="button" class="btn btn-primary" id="sendbtn">Guardar</button>
                    </div>
            
                </form>
            </div>
            

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

    <script>
        let ec = document.getElementById('eventContainer')
        let flag = false

        let form = document.getElementById('form')
        let sendbtn = document.getElementById('sendbtn')

        sendbtn.addEventListener('click', () => {
            if(this.flag){
                console.log('Se puede enviar')
                this.form.submit();
            }else{
                console.log('no se puede enviar')
            }
        })

        ec.addEventListener('click', event => {
            // console.log(event.target.id)
            let btnOrigin = event.target.id

            let radiobtnTrue = document.getElementById('radio-true')
            let radiobtnFalse = document.getElementById('radio-false')

            let btnTrue = document.getElementById('btn-true')
            let btnFalse = document.getElementById('btn-false')

            if(btnOrigin == 'btn-true'){
                // console.log(btn.classList.toggle())
                btnTrue.classList.add('active')
                btnFalse.classList.remove('active')

                radiobtnTrue.checked = true
                radiobtnFalse.checked = false

                this.flag = true
            }else if(btnOrigin == 'btn-false'){
                btnFalse.classList.add('active')
                btnTrue.classList.remove('active')

                radiobtnTrue.checked = false
                radiobtnFalse.checked = true

                this.flag = true
            }
        })
    </script>
</body>
</html>
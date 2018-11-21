const body = document.querySelector('body')
const main = body.querySelector('main')
const header = body.querySelector('header')
const section = body.querySelector('section')
const ul = header.querySelector('ul')
const p = body.querySelector('p#tempo')
getCategorias()
getPost()

async function getCategorias(){
	const req = await fetch('http://127.0.0.1/programacao2semestre/api/categoria/read.php')
	const resp = await req.json()
	for (let i=0; i< resp.length ; i++) {
		var li = document.createElement('li')
		li.innerText = resp[i].nome
		li.setAttribute("value", resp[i].id)
		li.addEventListener('click',()=>{
			getPost(resp[i].id)
		})
		ul.appendChild(li)
		
	}
}

async function getPost(idCategoria=null){
	let url='http://127.0.0.1/programacao2semestre/api/post/read.php'
	if(idCategoria!=null){
		url=url+'?id='+idCategoria
	}
	const req = await fetch(url)
	const resp = await req.json()
	main.innerHTML=''
	for (let i=0; i< resp.length ; i++) {
		let div = document.createElement('div')
		div.addEventListener('click',()=>{
			if(div.querySelectorAll('p').length==1){
				var p1 = document.createElement('p')
				p1.innerText = resp[i].autor
				var p2 = document.createElement('p')
				p2.innerText = resp[i].dt_criacao
				div.appendChild(p1)
				div.appendChild(p2)
			}

		})
		var h2 = document.createElement('h2')
		h2.innerText = resp[i].titulo
		var p = document.createElement('p')
		p.innerText = resp[i].texto
		div.appendChild(h2)
		div.appendChild(p)

		main.appendChild(div)
	}
}
	
navigator.geolocation.getCurrentPosition(pos => {
                pegarAlocaliza(pos.coords.latitude,pos.coords.longitude)
            })
        

async function pegarAlocaliza(lat,lng){

	let url="http://api.openweathermap.org/data/2.5/weather?lat="+lat+"&lon="+lng+"&units=metric&lang=pt&APPID=c144ba4eaa5f0aebc01c661169701dc7"
	var request = await fetch(url)
	var previsao = await request.json()
	console.log(previsao.name)
	p.innerText = previsao.name + previsao.main.temp
	
}



function getRandomColor() {
    var randomNumber = function() {
        return Math.floor((Math.random() * 255));
    };
    return {
        r: randomNumber()
        ,g: randomNumber()
        ,b: randomNumber()
    };
}

//console.log('Разрешение экрана: <b>'+window.innerWidth+'×'+window.innerHeight+'px.</b>');

function setBackgroundColor(elem, rgb) {
	var element = document.getElementById(elem);
    element.style.backgroundColor = "rgb("+ rgb.r + "," + rgb.g + "," + rgb.b + ")";
}

function getRandomHeight() {
        return Math.floor((Math.random() * 100) + 1);
}

function setHeight(elem, text, height) {
	var element = document.getElementById(elem);
    element.style.height = height + "%";
	var text = document.getElementById(text);
	
	if(height > 13)
		text.innerHTML = height + "%";
	else
	{
		text.style.position = "relative";
		text.style.top = "-65px";
		text.style.color = "rgb(0, 0, 0)";
		text.style.opacity = "0.6";
		text.innerHTML = height + "%";
	}
}

function calculateTextColor(rgb, elem) {
	var element = document.getElementById(elem);
	var sum = rgb.r + rgb.g + rgb.b;
	
	if(sum > 560)
	{
		element.style.color = "rgb(0, 0, 0)";
		element.style.opacity = "0.6";
	}
	else
	{
		element.style.color = "rgb(255, 255, 255)";
		element.style.opacity = "0.8";
	}
}

function animatedBar(elem, text, height) {
	var element = document.getElementById(elem);
	var text = document.getElementById(text);
	var currentHeight = 0;
	var timeout = setInterval(function() {
		if(currentHeight < height)
		{
			element.style.height = currentHeight + "%";
			
			if(height > 13)
				text.innerHTML = currentHeight + "%";
			else
			{
				text.style.position = "relative";
				text.style.top = "-65px";
				text.style.color = "rgb(0, 0, 0)";
				text.style.opacity = "0.6";
				text.innerHTML = currentHeight + "%";
			}
			
			currentHeight++;
		}
		else
		{
			element.style.height = height + "%";
			text.innerHTML = height + "%";
			clearInterval(timeout);
			currentHeight = 0;
		}
		
	}, 8)
}

var bar1Color = getRandomColor();
var bar2Color = getRandomColor();
var bar3Color = getRandomColor();

calculateTextColor(bar1Color, "text1");
calculateTextColor(bar2Color, "text2");
calculateTextColor(bar3Color, "text3");

setBackgroundColor("bar1", bar1Color);
setBackgroundColor("bar2", bar2Color);
setBackgroundColor("bar3", bar3Color);

var bar1Height = getRandomHeight();
var bar2Height = getRandomHeight();
var bar3Height = getRandomHeight();

animatedBar("bar1", "text1", bar1Height);
animatedBar("bar2", "text2", bar2Height);
animatedBar("bar3", "text3", bar3Height);
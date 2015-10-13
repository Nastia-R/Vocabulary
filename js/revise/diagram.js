function getBarHeight(bar, maxHeight) {
    if($('#'+bar).attr('id') == 'barRemember')
    {
    	return calculateHeightInPercent(maxHeight, app.calculateAnswersNum().right.length);
    }
	else if($('#'+bar).attr('id') == 'barMistakes')
	{
		return calculateHeightInPercent(maxHeight, app.calculateAnswersNum().wrong.length);
	}
	else if($('#'+bar).attr('id') == 'barTimeOut')
	{
		return calculateHeightInPercent(maxHeight, app.calculateAnswersNum().timeOut.length);
	}
}

function getBarTextValue(bar) {
    if($('#'+bar).attr('id') == 'barRemember')
    {
    	return app.calculateAnswersNum().right.length;
    }
	else if($('#'+bar).attr('id') == 'barMistakes')
	{
		return app.calculateAnswersNum().wrong.length;
	}
	else if($('#'+bar).attr('id') == 'barTimeOut')
	{
		return app.calculateAnswersNum().timeOut.length;
	}
}

function calculateHeightInPercent(maxHeight, neededHeight) {
	var heightInPercent = (parseInt(neededHeight)*100)/parseInt(maxHeight);
	return heightInPercent;
}

function setHeight(elem, text, height, textValue) {
	var element = document.getElementById(elem);
    element.style.height = height + "%";
}

function setAnswerCount(answerName, bar){
	document.getElementById(answerName).innerHTML += ' ' + getBarTextValue(bar);
}


function animatedBar(elem, text, height, textValue) {
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
				text.style.top = "-65%";
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

function startDiagram(maxHeight) {
	var barRememberHeight = getBarHeight('barRemember', maxHeight);
	var barMistakesHeight = getBarHeight('barMistakes', maxHeight);
	var barTimeOutHeight = getBarHeight('barTimeOut', maxHeight);

	setHeight("barRemember", "textRemember", barRememberHeight, getBarTextValue('barRemember'));
	setHeight("barMistakes", "textMistakes", barMistakesHeight, getBarTextValue('barMistakes'));
	setHeight("barTimeOut", "textTimeOut", barTimeOutHeight, getBarTextValue('barTimeOut'));

	setAnswerCount('nameRemember', 'barRemember');
	setAnswerCount('nameMistakes', 'barMistakes');
	setAnswerCount('nameTimeOut', 'barTimeOut');
}
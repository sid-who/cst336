//your javascript goes here
/*        var randomNumber = 5+6;
        console.log(randomNumber);
 */
    /*$(".tagline").click(function() {
    alert("jQuery works!");
});*/

/*global $*/
        
        //true random value
        var randomNumber = Math.floor(Math.random()*99)+1;
        console.log(randomNumber);
        var guesses = document.querySelector('#guesses');
        var lastResult = document.querySelector('#lastResult');
        var lowOrHi = document.querySelector('#lowOrHi');
        
        var guessSubmit = document.querySelector('.guessSubmit');
        var guessField = document.querySelector('.guessField');
        
        var guessCount = 1;
        var resetButton = document.querySelector('#reset');
        resetButton.style.display = 'none';
        
        //keep track of wins and losses
        var wins = document.querySelector('#wins');
        var loss = document.querySelector('#loss');
        
        var winTrack = 0;
        var lossTrack = 0;
        
        function scoreboard()
        {
            if(winTrack > 0 || lossTrack > 0)
            {
                wins.innerHTML = 'Wins: ' + winTrack;
                loss.innerHTML = 'Losses: ' + lossTrack;
            }
        }
        
        function checkGuess()
        {
            //alert('I am a placeholder');
            var userGuess = Number(guessField.value);
            
            if(isNaN(userGuess) == true)
            {
                guesses.innerHTML = 'That is not a number..';
                lastResult.style.backgroundColor = 'cyan';
                wrongInput();
            }
            
            if(guessCount === 1)
            {
                guesses.innerHTML = 'Previous Guesses: ';
            }
            guesses.innerHTML += userGuess + ' ';
            
            if(userGuess === randomNumber)
            {
                lastResult.innerHTML = 'Congratulations! You got it right!';
                lastResult.style.backgroundColor = 'green';
                lowOrHi.innerHTML = '';
                winTrack += 1;
                setGameOver();
            }
            else if(guessCount === 7)
            {
                lastResult.innerHTML = 'Sorry, you lost!';
                lossTrack += 1;
                setGameOver();
            }
            else
            {
                lastResult.innerHTML = 'Wrong!';
                lastResult.style.backgroundColor = 'red';
                if(userGuess < randomNumber && userGuess < 100 && userGuess > 0)
                {
                    lowOrHi.innerHTML = 'Last guess was too low!';
                    addGuess();
                }
                else if(userGuess > randomNumber && userGuess < 100 && userGuess > 0)
                {
                    lowOrHi.innerHTML = 'Last guess was too high!';
                    addGuess();
                }
                else if(userGuess > 99)
                {
                    lowOrHi.innerHTML = 'Guess value out of bounds!';
                    wrongInput();
                    
                }
            }
            
        }
        
        function addGuess()
        {
            guessCount++;
            guessField.value = '';
            guessField.focus();
        }
        
        guessSubmit.addEventListener('click', checkGuess);
        
        function wrongInput()
        {
            guessField.value = '';
            checkGuess();
        }
        
        function setGameOver()
        {
            guessField.disabled = true;
            guessSubmit.disable = true;
            resetButton.style.display = 'inline';
            scoreboard();
            resetButton.addEventListener('click', resetGame);
            //$("resetButton").on("click", resetGame());
        }
        
        function resetGame()
        {
            guessCount = 1;
            
            var resetParas =  document.querySelectorAll('.resultParas p');
            for(var i = 0; i < resetParas.length; i++)
            {
                resetParas[i].textContent = '';
            }
            
             resetButton.style.display = 'none';
             
             guessField.disabled = false;
             guessSubmit.disabled = false;
             guessField.value = '';
             guessField.focus();
             
             lastResult.style.backgroundColor = 'white';
             
             randomNumber = Math.floor(Math.random() * 99) + 1;
             
             console.log(randomNumber);
             //document.getElementById("numberToGuess").innerHTML = randomNumber;
             
        }
        /*
        console.log(randomNumber);
        document.getElementById("numberToGuess").innerHTML = randomNumber;
        */
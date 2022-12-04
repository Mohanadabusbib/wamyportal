    const carCard = document.querySelectorAll('#carCard');
        
        
        for (let index = 0; index < carCard.length; index++) {
            let realIndex = index + 1,
                startDate =  document.getElementById('startDate'+realIndex),
                endDate = document.getElementById('endDate'+realIndex),
                carInfo = document.getElementById('carInfo'+realIndex),
                winnerInfo = document.getElementById('winnerInfo'+realIndex),
                
                
                
                saveBtn = document.getElementById('saveBtn'+realIndex),
                

                
                endDays,endHours,endMints,endSeconds,

                               
                edaysEl = document.getElementById('edays'+realIndex),
                ehoursEl = document.getElementById('ehours'+realIndex),
                eminsEl = document.getElementById('emins'+realIndex),
                esecondsEl = document.getElementById('eseconds'+realIndex);

                
                
                
                setInterval(() => {
                    const enewEndDate = new Date(endDate.value),
                    ecurrentDate = new Date(),
                    etotalSeconds = (enewEndDate - ecurrentDate) / 1000,
                    edays = Math.floor(etotalSeconds / 3600 /24),
                    ehours = Math.floor(etotalSeconds / 3600) % 24,
                    eminutes = Math.floor(etotalSeconds / 60) % 60,
                    eseconds = Math.floor(etotalSeconds) % 60;

                    endDays = edays < 0 ? 0 : formatTime(edays);
                    endHours = ehours < 0 ? 0 : formatTime(ehours);
                    endMints = eminutes < 0 ? 0 : formatTime(eminutes);
                    endSeconds = eseconds < 0 ? 0 : formatTime(eseconds);   
                    edaysEl.innerHTML = endDays;
                    ehoursEl.innerHTML = endHours;
                    eminsEl.innerHTML = endMints;
                    esecondsEl.innerHTML = endSeconds;   
                    /*endAuction(endDays,endHours,endMints,endSeconds)  ;*/
                    console.log(endDate.textContent);
                }, 1000);
                
                
                
                /*function endAuction(days,hours,mins,seconds){
                    if (isNaN(days)) {
                        return NaN;
                      }else{
                        if (days == 0 && hours == 0 && mins == 0 && seconds == 0) {
                            winnerInfo.style.display = "block";
                            carInfo.style.display = "none";
                        } else if(days === NaN) {
                            saveBtn.style.display = "none";
                        }
                        else{
                            winnerInfo.style.display = "none";
                        }
                      }
                    
                    
                }*/
        }

    function formatTime(time) {
        return time < 10 ? (`0${time}`) : time;
    }

   /* startDate.forEach(element => {
         const x = Math.date() - Math.date();
        console.log(x); 
        const date1 = new Date('7/13/2010');
        const date2 = new Date('12/15/2010');
        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        console.log(diffTime + " milliseconds");
        console.log(diffDays + " days");
        
    });
    for (let index = 0; index < startDate.length; index++) {
        const startDate1 = startDate[index],
        endDate1 = endDate[index];
        const diffTime = Math.abs(endDate1.value - startDate1.value);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        console.log(endDate1); 
        console.log(diffTime + " milliseconds");
        console.log(diffDays + " days");
        console.log(diffTime);
        
    }*/
    
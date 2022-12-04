function calc() {
    let sprAvilb = document.getElementById('sprAvilb').value,       /* وجود كافل */
        endServiceEmp = document.getElementById('endServiceEmp').value,    /* نهاية خدمة الموظف */
        balanceboxEmp = document.getElementById('balanceboxEmp').value,     /* رصيد الصندوق للموظف */    
        totalGuaranteesEmp = document.getElementById('totalGuaranteesEmp'),     /* إجمالي الضمانات للموظف */
        debtFurnitureEmp = document.getElementById('debtFurnitureEmp').value,   /* مديونية الاثاث للموظف */
        debtCarEmp = document.getElementById('debtCarEmp').value,               /* مديونية السيارات للموظف */
        anothSponosrEmp = document.getElementById('anothSponosrEmp').value, /* كفالة موظف اخر للموظف */
        totalCommitmentEmp = document.getElementById('totalCommitmentEmp'),         /* إجمالي الالتزامات للموظف */
        guaranteesAvailableEmp = document.getElementById('guaranteesAvailableEmp'),   /* الضمانات المتاحة  الموظف*/

        
        totalGuaranteesAll = document.getElementById('totalGuaranteesAll'),     /* إجمالي الضمانات */
        totalCommitmentAll = document.getElementById('totalCommitmentAll'),     /* إجمالي الالتزامات */
        guaranteesAvailable = document.getElementById('guaranteesAvailable'),   /* الضمانات المتاحة */
       
        purchasingValueGurnt = document.getElementById('purchasingValueGurnt'), /* مبلغ الضمان المطلوب */
        purchasingValue = document.getElementById('purchasingValue'),           /* القيمة الشرائية */

        aprovalSponsor  = document.getElementById('aprovalSponsor'); /* موافقة الكافل */

    totalGuaranteesEmp.value = parseFloat(endServiceEmp) + parseFloat(balanceboxEmp); /* ناتج إجمالي الضمانات للموظف */
    totalCommitmentEmp.value = parseFloat(debtFurnitureEmp) + parseFloat(debtCarEmp) + parseFloat(anothSponosrEmp);  /* ناتج إجمالي الإلتزامات للموظف*/
    guaranteesAvailableEmp.value = parseFloat(totalGuaranteesEmp.value) - parseFloat(totalCommitmentEmp.value);     /*  ناتج الضمانات المتاحة الموظف*/

    
    if (sprAvilb == 0) {
        let endServiceSpr = 0,     /* نهاية خدمة الكافل */
            balanceboxSpr = 0,     /* رصيد الصندوق الكافل */
            totalGuaranteesSpr = 0,      /* إجمالي الضمانات الكافل */
            debtFurnitureSpr = 0,    /* مديونية الاثاث الكافل */
            debtCarSpr = 0,               /* مديونية السيارات الكافل */
            anothSponosrSpr = 0,      /* كفالة موظف اخر الكافل */
            totalCommitmentSpr = 0,       /* إجمالي الالتزامات الكافل */         
            guaranteesAvailableSpr = 0;  /* الضمانات المتاحة  الكافل*/

            totalGuaranteesSpr.value = 0; /* ناتج إجمالي الضمانات للكافل */
            totalCommitmentSpr.value = 0; /* ناتج إجمالي الإلتزامات للكافل*/
            guaranteesAvailableSpr.value = 0; /*  ناتج الضمانات المتاحة للكافل*/
            totalGuaranteesAll.value = parseFloat(totalGuaranteesEmp.value) + 0;     /* ناتج إجمالي الالتزامات */
            totalCommitmentAll.value = parseFloat(totalCommitmentEmp.value) + 0;     /* ناتج الضمانات المتاحة */            
    }else if(sprAvilb == 1){
        let endServiceSpr = document.getElementById('endServiceSpr').value,     /* نهاية خدمة الكافل */
            balanceboxSpr = document.getElementById('balanceboxSpr').value,     /* رصيد الصندوق الكافل */
            totalGuaranteesSpr = document.getElementById('totalGuaranteesSpr'),      /* إجمالي الضمانات الكافل */
            debtFurnitureSpr = document.getElementById('debtFurnitureSpr').value,    /* مديونية الاثاث الكافل */
            debtCarSpr = document.getElementById('debtCarSpr').value,               /* مديونية السيارات الكافل */
            anothSponosrSpr = document.getElementById('anothSponosrSpr').value,      /* كفالة موظف اخر الكافل */
            totalCommitmentSpr = document.getElementById('totalCommitmentSpr'),       /* إجمالي الالتزامات الكافل */         
            guaranteesAvailableSpr = document.getElementById('guaranteesAvailableSpr');  /* الضمانات المتاحة  الكافل*/

            if (aprovalSponsor.value == 'موافقة الكافل') {
                totalGuaranteesSpr.value = parseFloat(endServiceSpr) + parseFloat(balanceboxSpr); /* ناتج إجمالي الضمانات للكافل */
                totalCommitmentSpr.value = parseFloat(debtFurnitureSpr) + parseFloat(debtCarSpr) + parseFloat(anothSponosrSpr); /* ناتج إجمالي الإلتزامات للكافل*/
                guaranteesAvailableSpr.value = parseFloat(totalGuaranteesSpr.value) - parseFloat(totalCommitmentSpr.value); /*  ناتج الضمانات المتاحة للكافل*/
                totalGuaranteesAll.value = parseFloat(totalGuaranteesEmp.value) + parseFloat(totalGuaranteesSpr.value);     /* ناتج إجمالي الالتزامات */
                totalCommitmentAll.value = parseFloat(totalCommitmentEmp.value) + parseFloat(totalCommitmentSpr.value);     /* ناتج الضمانات المتاحة */
            } else {
                totalGuaranteesSpr.value = 0; /* ناتج إجمالي الضمانات للكافل */
                totalCommitmentSpr.value = 0; /* ناتج إجمالي الإلتزامات للكافل*/
                guaranteesAvailableSpr.value = 0; /*  ناتج الضمانات المتاحة للكافل*/
                totalGuaranteesAll.value = parseFloat(totalGuaranteesEmp.value) + 0;     /* ناتج إجمالي الالتزامات */
                totalCommitmentAll.value = parseFloat(totalCommitmentEmp.value) + 0;     /* ناتج الضمانات المتاحة */ 
            }
        

    }

    guaranteesAvailable.value = parseFloat(totalGuaranteesAll.value) - parseFloat(totalCommitmentAll.value);     /* ناتج إجمالي الضمانات */
    purchasingValueGurnt.value = purchasingValue.value;
}

function calc() {
    let endServiceEmp = document.getElementById('endServiceEmp').value,    /* نهاية خدمة الموظف */
        balanceboxEmp = document.getElementById('balanceboxEmp').value,     /* رصيد الصندوق للموظف */    
        totalGuaranteesEmp = document.getElementById('totalGuaranteesEmp'),     /* إجمالي الضمانات للموظف */
        debtFurnitureEmp = document.getElementById('debtFurnitureEmp').value,   /* مديونية الاثاث للموظف */
        debtCarEmp = document.getElementById('debtCarEmp').value,               /* مديونية السيارات للموظف */
        anothSponosrEmp = document.getElementById('anothSponosrEmp').value, /* كفالة موظف اخر للموظف */
        totalCommitmentEmp = document.getElementById('totalCommitmentEmp'),         /* إجمالي الالتزامات للموظف */
        guaranteesAvailableEmp = document.getElementById('guaranteesAvailableEmp'),   /* الضمانات المتاحة  الموظف*/

        endServiceSpr = document.getElementById('endServiceSpr').value,     /* نهاية خدمة الكافل */
        balanceboxSpr = document.getElementById('balanceboxSpr').value,     /* رصيد الصندوق الكافل */
        totalGuaranteesSpr = document.getElementById('totalGuaranteesSpr'),      /* إجمالي الضمانات الكافل */
        debtFurnitureSpr = document.getElementById('debtFurnitureSpr').value,    /* مديونية الاثاث الكافل */
        debtCarSpr = document.getElementById('debtCarSpr').value,               /* مديونية السيارات الكافل */
        anothSponosrSpr = document.getElementById('anothSponosrSpr').value,      /* كفالة موظف اخر الكافل */
        totalCommitmentSpr = document.getElementById('totalCommitmentSpr'),       /* إجمالي الالتزامات الكافل */         
        guaranteesAvailableSpr = document.getElementById('guaranteesAvailableSpr'),  /* الضمانات المتاحة  الكافل*/
        totalGuaranteesAll = document.getElementById('totalGuaranteesAll'),     /* إجمالي الضمانات */
        totalCommitmentAll = document.getElementById('totalCommitmentAll'),     /* إجمالي الالتزامات */
        guaranteesAvailable = document.getElementById('guaranteesAvailable'),   /* الضمانات المتاحة */

        purchasingValueGurnt = document.getElementById('purchasingValueGurnt'), /* مبلغ الضمان المطلوب */
        purchasingValue = document.getElementById('purchasingValue');           /* القيمة الشرائية */


    totalGuaranteesEmp.value = parseFloat(endServiceEmp) + parseFloat(balanceboxEmp); /* ناتج إجمالي الضمانات للموظف */
    totalCommitmentEmp.value = parseFloat(debtFurnitureEmp) + parseFloat(debtCarEmp) + parseFloat(anothSponosrEmp);  /* ناتج إجمالي الإلتزامات للموظف*/
    guaranteesAvailableEmp.value = parseFloat(totalGuaranteesEmp.value) - parseFloat(totalCommitmentEmp.value);     /*  ناتج الضمانات المتاحة الموظف*/

    totalGuaranteesSpr.value = parseFloat(endServiceSpr) + parseFloat(balanceboxSpr); /* ناتج إجمالي الضمانات للكافل */
    totalCommitmentSpr.value = parseFloat(debtFurnitureSpr) + parseFloat(debtCarSpr) + parseFloat(anothSponosrSpr); /* ناتج إجمالي الإلتزامات للكافل*/
    guaranteesAvailableSpr.value = parseFloat(totalGuaranteesSpr.value) - parseFloat(totalCommitmentSpr.value); /*  ناتج الضمانات المتاحة للكافل*/
              
    guaranteesAvailable.value = parseFloat(totalGuaranteesAll.value) - parseFloat(totalCommitmentAll.value);     /* ناتج إجمالي الضمانات */
    totalGuaranteesAll.value = parseFloat(totalGuaranteesEmp.value) + parseFloat(totalGuaranteesSpr.value);     /* ناتج إجمالي الالتزامات */
    totalCommitmentAll.value = parseFloat(totalCommitmentEmp.value) + parseFloat(totalCommitmentSpr.value);     /* ناتج الضمانات المتاحة */
    
        /* sprId = document.getElementById('sprId').value; */ /* عدم وجود كافل */   
    purchasingValueGurnt.value = purchasingValue.value;
}

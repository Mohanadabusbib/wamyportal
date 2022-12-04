<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxordersanalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxordersanalyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boxorders_id'); /* رقم الطلب الطلب  */
            $table->foreign('boxorders_id')->references('id')->on('boxorders');
            $table->decimal('salaryEmp'); /* الراتب */
            $table->decimal('deductionsHr'); /* إستقطاعات */
            $table->decimal('deductionsBox'); /* إستقطاعات الصندوق */
            $table->decimal('purchasingValue')->nullable();  /* القيمة الشرائية */
            $table->decimal('endServiceEmp')->nullable();   /* نهاية الخدمة للموظف */
            $table->decimal('balanceboxEmp')->nullable();   /* رصيد الصندوق للموظف */
            $table->string('typeOrder')->nullable();  /* نوع الطلب */
            $table->decimal('premiumBox')->nullable(); /* قسط الصندوق */
            $table->decimal('debtFurnitureEmp')->nullable(); /* مديونية الأثاث */
            $table->decimal('debtCarEmp')->nullable();      /* مديونية السيارات */
            $table->decimal('anothSponosrEmp')->nullable(); /* كفالة موظف آخر */
                      
            
            
            
            $table->integer('sprId')->nullable(); /* الكافل */
            $table->decimal('salarySpr')->nullable(); /* راتب الكافل */

            $table->decimal('endServiceSpr')->nullable();   /* نهاية الخدمة للموظف */
            $table->decimal('balanceboxSpr')->nullable();   /* رصيد الصندوق للموظف */
            $table->decimal('debtFurnitureSpr')->nullable();    /* مديونية الأثاث */
            $table->decimal('debtCarSpr')->nullable();      /* مديونية السيارات */
            $table->boolean('anothSponosrSpr')->nullable(); /* كفالة موظف آخر */
            $table->integer('evaluation')->nullable(); /* تقييم الوضع المالي لمقدم الطلب   */
            $table->text('reson')->nullable(); /* الضمانات التي يمنح عليها  */
            $table->integer('userEntry')->nullable();
            $table->boolean('status')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxordersanalyses');
    }
}

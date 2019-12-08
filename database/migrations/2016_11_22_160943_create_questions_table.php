<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->unsigned()->nullable();
            $table->foreign('topic_id', 'fk_256_topic_topic_id_question')->references('id')->on('topics');
            $table->text('question_text')->nullable();
            $table->text('code_snippet')->nullable();
            $table->text('answer_explanation')->nullable();
            $table->string('more_info_link')->nullable();

            //追加
            $table->string('category_name')->default(0);
            $table->string('item_difficulty')->default(0);
            $table->string('discrimination_power')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}

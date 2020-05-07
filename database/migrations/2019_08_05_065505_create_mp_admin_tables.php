<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpa_mp_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('公众号名称');
            $table->string('sign')->index()->unique()->comment('自定义标识');
            $table->string('raw_id', 200)->index()->unique()->comment('原始 id');
            $table->string('app_id', 200)->index()->unique()->comment('app_id');
            $table->string('secret', 200)->comment('secret');
            $table->string('token')->comment('token');
            $table->string('aes_key')->nullable()->comment('aes_key');
            $table->string('qr_code')->nullable()->comment('二维码');
            $table->timestamps();
        });

        Schema::create('mpa_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mp_info_id')->comment('公众号id');
            $table->json('content')->comment('菜单内容');
            $table->string('remark')->nullable()->comment('备注');
            $table->timestamps();
        });
        Schema::create('mpa_user_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mp_info_id')->comment('公众号id');
            $table->string('openid');
            $table->longText('content')->comment('内容');
            $table->tinyInteger('type')->comment('类型');
            $table->string('remark')->nullable()->comment('备注');
            $table->timestamps();
        });
        Schema::create('mpa_user_message_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mp_info_id')->comment('公众号id');
            $table->bigInteger('user_message_id')->comment('关联用户消息id');
            $table->longText('content')->comment('内容');
            $table->tinyInteger('type')->comment('类型');
            $table->string('remark')->nullable()->comment('备注');
            $table->timestamps();
        });
        Schema::create('mpa_auto_reply_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mp_info_id')->comment('公众号id');
            $table->text('text')->comment('消息内容');
            $table->tinyInteger('type')->comment('类型');
            $table->tinyInteger('match_type')->comment('匹配类型');
            $table->bigInteger('message_id')->comment('关联消息id');
            $table->string('remark')->nullable()->comment('备注');
            $table->timestamps();
        });
        Schema::create('mpa_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mp_info_id')->comment('公众号id');
            $table->tinyInteger('type')->comment('类型');
            $table->json('content')->comment('消息内容');
            $table->string('remark')->nullable()->comment('备注');
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
        Schema::dropIfExists('mpa_mp_info');
        Schema::dropIfExists('mpa_menus');
        Schema::dropIfExists('mpa_user_messages');
        Schema::dropIfExists('mpa_user_message_replies');
        Schema::dropIfExists('mpa_auto_reply_configs');
        Schema::dropIfExists('mpa_messages');
    }
}

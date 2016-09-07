<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteCascadeForeign extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // <editor-fold defaultstate="collapsed" desc="bids">
        Schema::table('bids', function(Blueprint $table){
            $table->dropForeign('bids_auction_foreign');
            $table->dropForeign('bids_enrollment_foreign');
            $table->dropForeign('bids_user_foreign');
            $table->foreign('auction')->references('id')->on('auctions')->onDelete('cascade');
            $table->foreign('enrollment')->references('id')->on('enrollments')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');    
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="addresses">
        Schema::table('addresses', function(Blueprint $table) {
            $table->dropForeign('addresses_user_foreign');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="auctions_fav">
        Schema::table('auctions_fav', function(Blueprint $table) {
            $table->dropForeign('auctions_fav_auction_id_foreign');
            $table->dropForeign('auctions_fav_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="bills_infos">
        Schema::table('bills_infos', function(Blueprint $table) {
            $table->dropForeign('bills_infos_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="categories">
        Schema::table('categories', function(Blueprint $table) {
            $table->dropForeign('categories_parentcategory_foreign');
            $table->foreign('parentCategory')->references('id')->on('categories')->onDelete('cascade');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="enrollments">
        Schema::table('enrollments', function(Blueprint $table) {
            $table->dropForeign('enrollments_auction_foreign');
            $table->dropForeign('enrollments_user_foreign');
            $table->foreign('auction')->references('id')->on('auctions')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="payments">
        Schema::table('payments', function(Blueprint $table) {
            $table->dropForeign('payments_auction_foreign');
            $table->dropForeign('payments_user_foreign');
            $table->foreign('auction')->references('id')->on('auctions')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="preference_user">
        Schema::table('preference_user', function(Blueprint $table) {
           $table->dropForeign('preference_user_preference_id_foreign');
            $table->dropForeign('preference_user_user_id_foreign');
            $table->foreign('preference_id')->references('id')->on('preferences')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="request_bills">
        Schema::table('request_bills', function(Blueprint $table) {
            $table->dropForeign('request_bills_auction_id_foreign');
            $table->dropForeign('request_bills_enrollment_id_foreign');
            $table->dropForeign('request_bills_user_id_foreign');
            $table->foreign('auction_id')->references('id')->on('preferences')->onDelete('cascade');
            $table->foreign('enrollment_id')->references('id')->on('enrollments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        // </editor-fold>
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        // <editor-fold defaultstate="collapsed" desc="bids">
        Schema::table('bids', function(Blueprint $table){
            $table->dropForeign('bids_auction_foreign');
            $table->dropForeign('bids_enrollment_foreign');
            $table->dropForeign('bids_user_foreign');
            $table->foreign('auction')->references('id')->on('auctions');
            $table->foreign('enrollment')->references('id')->on('enrollments');
            $table->foreign('user')->references('id')->on('users');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="addresses">
        Schema::table('addresses', function(Blueprint $table) {
            $table->dropForeign('addresses_user_foreign');
            $table->foreign('user')->references('id')->on('users');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="actuions_fav">
        Schema::table('auctions_fav', function(Blueprint $table) {
            $table->dropForeign('auctions_fav_auction_id_foreign');
            $table->dropForeign('auctions_fav_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('auction_id')->references('id')->on('auctions');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="bills_infos">
        Schema::table('bills_infos', function(Blueprint $table) {
            $table->dropForeign('bills_infos_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="bills_infos">
        Schema::table('categories', function(Blueprint $table) {
            $table->dropForeign('categories_parentcategory_foreign');
            $table->foreign('parentCategory')->references('id')->on('categories');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="enrollments">
        Schema::table('enrollments', function(Blueprint $table) {
            $table->dropForeign('enrollments_auction_foreign');
            $table->dropForeign('enrollments_user_foreign');
            $table->foreign('auction')->references('id')->on('auctions');
            $table->foreign('user')->references('id')->on('users');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="payments">
        Schema::table('payments', function(Blueprint $table) {
            $table->dropForeign('payments_auction_foreign');
            $table->dropForeign('payments_user_foreign');
            $table->foreign('auction')->references('id')->on('auctions');
            $table->foreign('user')->references('id')->on('users');
        });
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="preference_user">
        Schema::table('preference_user', function(Blueprint $table) {
            $table->dropForeign('preference_user_preference_id_foreign');
            $table->dropForeign('preference_user_user_id_foreign');
            $table->foreign('preference_id')->references('id')->on('preferences');
            $table->foreign('user_id')->references('id')->on('users');
        });
        // </editor-fold>
         // <editor-fold defaultstate="collapsed" desc="request_bills">
        Schema::table('request_bills', function(Blueprint $table) {
            $table->dropForeign('request_bills_auction_id_foreign');
            $table->dropForeign('request_bills_enrollment_id_foreign');
            $table->dropForeign('request_bills_user_id_foreign');
            $table->foreign('auction_id')->references('id')->on('preferences');
            $table->foreign('enrollment_id')->references('id')->on('enrollments');
            $table->foreign('user_id')->references('id')->on('users');
        });
        // </editor-fold>
    }

}

#!/usr/bin/perl -w

use strict;
use warnings;
use LWP::UserAgent;
use JSON;

if ( @ARGV!=4 )
{
	print "Usage: <parcel_number> and <detour_type> and <delivery_day> and <create/update/delete>\n";
	exit;
}
my $parcel_number = shift;
my $detour_type = shift;
my $delivery_day = shift;
my $action = shift;

my $url = "http://127.0.0.1/pip/php/main.php";


my $ua = LWP::UserAgent->new;
$ua->default_header('Content-Type' => 'application/json');

if ($action eq 'post'){
    my %data = (
        parcel_number => $parcel_number,
        type => $detour_type ,
        delivery_day => $delivery_day
    );

    my $json_str = encode_json(\%data);

    my $response = $ua->post($url, Content => $json_str);

    if ($response->is_success) {
        print "JSON object sent successfully: ".$response->code()."\n";
    } else {
        print "Error sending JSON object: " . $response->code() . "\n";
    }


}elsif($action eq 'update'){
    my %data = (
        parcel_number => $parcel_number,
        type => $detour_type ,
        delivery_day => $delivery_day
    );

    my $json_str = encode_json(\%data);
    my $response = $ua->put($url, Content => $json_str);

    if ($response->is_success) {
        print "JSON object sent successfully: ".$response->code()."\n";
    } else {
        print "Error sending JSON object: " . $response->code() . "\n";
    }

}elsif($action eq 'delete'){
    my %data = (
        parcel_number => $parcel_number
    );

    my $json_str = encode_json(\%data);
    my $response = $ua->delete($url, Content => $json_str);

    if ($response->is_success) {
        print "JSON object sent successfully: ".$response->code()."\n";
    } else {
        print "Error sending JSON object: " . $response->code() . "\n";
    }
}else {
    print "incorrect action";
    exit;
}
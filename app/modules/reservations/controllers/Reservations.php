<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Reservations Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Robert Christian Obias <robert.obias@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */
class Reservations extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->model('reservations_model');
        $this->load->model('customers/customers_model');
    }

    public function index()
    {
        redirect(site_url());
    }

    public function form($ref_no)
    {
        $data = '0000000301199E8DB80B + 1246454226 + https://web.ortigas.local/reservations/notif + https://web.ortigas.local/reservations/response + Juan + Cruz + dela + 1609 Cityland 10 HV Dela Costa St. + Salecedo Village + makati + MM + PH + 1200 + ronald.magleo@paynamics.net + 3308772 + 122.55.82.180 + 150.00 + USD + No + FD2CE586D02AEC25B87D392AF95D69DB';

        //echo hash ('SHA512', $data); exit;
        echo base64_decode('PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiID8+PFJlcXVlc3Q+PG9yZGVycz48aXRlbXM+PEl0ZW1zPjxpdGVtbmFtZT5QYWNrYWdlIEM8L2l0ZW1uYW1lPjxxdWFudGl0eT4xPC9xdWFudGl0eT48YW1vdW50PjE1MC4wMDwvYW1vdW50PjwvSXRlbXM+PC9pdGVtcz48L29yZGVycz48bWlkPjAwMDAwMDE0MDQxMTRBNTQ2QzVEPC9taWQ+PHJlcXVlc3RfaWQ+MTI0NjQ1NDIyNjwvcmVxdWVzdF9pZD48aXBfYWRkcmVzcz48L2lwX2FkZHJlc3M+PG5vdGlmaWNhdGlvbl91cmw+aHR0cHM6Ly90ZXN0cHRpLnBheXNlcnYubmV0L3BheXRyYXZlbC9ub3RpZmljYXRpb25yZWNlaXZlci5hc3B4PC9ub3RpZmljYXRpb25fdXJsPjxyZXNwb25zZV91cmw+aHR0cHM6Ly90ZXN0cHRpLnBheXNlcnYubmV0L3BheXRyYXZlbC9EZWZhdWx0LmFzcHg8L3Jlc3BvbnNlX3VybD48Y2FuY2VsX3VybD5odHRwczovL3Rlc3RwdGkucGF5c2Vydi5uZXQvcGF5dHJhdmVsL0RlZmF1bHQuYXNweDwvY2FuY2VsX3VybD48bXRhY191cmw+PC9tdGFjX3VybD48ZGVzY3JpcHRvcl9ub3RlPidNeSBEZXNjcmlwdG9yICsxODAwODAwODAwOCc8L2Rlc2NyaXB0b3Jfbm90ZT48Zm5hbWU+SnVhbjwvZm5hbWU+PGxuYW1lPkNydXo8L2xuYW1lPjxtbmFtZT5kZWxhPC9tbmFtZT48YWRkcmVzczE+MTYwOSBDaXR5bGFuZCAxMCBIViBEZWxhIENvc3RhIFN0LjwvYWRkcmVzczE+PGFkZHJlc3MyPlNhbGVjZWRvIFZpbGxhZ2U8L2FkZHJlc3MyPjxjaXR5Pm1ha2F0aTwvY2l0eT48c3RhdGU+TU08L3N0YXRlPjxjb3VudHJ5PlBIPC9jb3VudHJ5Pjx6aXA+MTIwMDwvemlwPjxzZWN1cmUzZD5OTzwvc2VjdXJlM2Q+PHRyeHR5cGU+c2FsZTwvdHJ4dHlwZT48ZW1haWw+cm9uYWxkLm1hZ2xlb0BwYXluYW1pY3MubmV0PC9lbWFpbD48cGhvbmU+MzMwODc3MjwvcGhvbmU+PG1vYmlsZT4wOTE3ODEzNDgyODwvbW9iaWxlPjxjbGllbnRfaXA+MTIyLjU1LjgyLjE4MDwvY2xpZW50X2lwPjxhbW91bnQ+MTUwLjAwPC9hbW91bnQ+PGN1cnJlbmN5PlVTRDwvY3VycmVuY3k+PG1sb2dvX3VybD5odHRwczovL3Rlc3RwdGkucGF5c2Vydi5uZXQvcGF5dHJhdmVsL2ltYWdlcy9wYXl0cmF2ZWxfbG9nby5wbmc8L21sb2dvX3VybD48cG1ldGhvZD48L3BtZXRob2Q+PHNpZ25hdHVyZT40NjBiNWZiOTY3YzY2YjYzNzU3OWVhNDU0Mzg0ZmE5Zjc0MmI3NjFhOWJhNGRlZjA5Zjk2YzcyNDkyOTc2NGQ5NmY5ZDU2MjAyMGY4NzVjMmIwYzRjZmZkMGQ1OTU3NTY0NmNlMjM4YThjMmY1NmRkNDExZGMzOWM2OTdhZWEyYjwvc2lnbmF0dXJlPjwvUmVxdWVzdD4=');
        exit;
        
        echo base64_encode('<?xml version="1.0" encoding="utf-8"?>
                            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                            <soap:Body>
                                <saleResponse xmlns="https://testpti.payserv.net/webpayment/default.aspx">
                                    <saleResult>
                                        <application>
                                            <orders>
                                                <items>
                                                    <Items>
                                                        <itemname>Package C</itemname>
                                                        <quantity>1</quantity>
                                                        <amount>150.00</amount>
                                                    </Items>
                                                </items>
                                            </orders>
                                            <merchantid>0000000301199E8DB80B</merchantid>
                                            <request_id>1246454226</request_id>
                                            <notification_url>https://web.ortigas.local/reservations/notif</notification_url>
                                            <response_url>https://web.ortigas.local/reservations/response</response_url>
                                            <cancel_url>https://web.ortigas.local/reservations/cancel</cancel_url>
                                            <fname>Juan</fname>
                                            <lname>Cruz</lname>
                                            <mname>dela</mname>
                                            <address1>1609 Cityland 10 HV Dela Costa St.</address1>
                                            <address2>Salecedo Village</address2>
                                            <city>makati</city>
                                            <state>MM</state>
                                            <country>PH</country>
                                            <zip>1200</zip>
                                            <secure3d>NO</secure3d>
                                            <trxtype>sale</trxtype>
                                            <email>ronald.magleo@paynamics.net</email>
                                            <phone>3308772</phone>
                                            <mobile>09178134828</mobile>
                                            <client_ip>122.55.82.180</client_ip>
                                            <amount>150.00</amount>
                                            <currency>USD</currency>
                                            <signature>ed58ed586f36788a6c36465aceb810b8a7a19abf587680215a2d8d16064e2fdab980c4e2e1943cc0541ec5898308bd8c115c89f57ea0603d7c5b6ce033658af0</signature>
                                        </application>
                                    </saleResult>
                                </saleResponse>
                            </soap:Body>
                        </soap:Envelope>');
     exit;

     echo base64_encode('<?xml version="1.0" encoding="utf-8"?>
                        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                        xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                        xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                            <soap:Body>
                                <saleResponse xmlns="http://test.payserv.net/">
                                    <saleResult>
                                        <application>
                                        <orders>
                                        <items>
                                            <Items>
                                                <itemname>Package C</itemname>
                                                <quantity>1</quantity>
                                                <amount>150.00</amount>
                                            </Items>
                                        </items>
                                    </orders>
                                    <mid>0000001404114A546C5D</mid>
                                    <request_id>1246454226</request_id>
                                    <ip_address></ip_address>
                                    <notification_url>https://testpti.payserv.net/paytravel/notificationreceiver.aspx</notification_url>
                                    <response_url>https://testpti.payserv.net/paytravel/Default.aspx</response_url>
                                    <cancel_url>https://testpti.payserv.net/paytravel/Default.aspx</cancel_url>
                                    <mtac_url></mtac_url>
                                    <descriptor_note>adas</descriptor_note>
                                    <fname>Juan</fname>
                                    <lname>Cruz</lname>
                                    <mname>dela</mname>
                                    <address1>1609 Cityland 10 HV Dela Costa St.</address1>
                                    <address2>Salecedo Village</address2>
                                    <city>makati</city>
                                    <state>MM</state>
                                    <country>PH</country>
                                    <zip>1200</zip>
                                    <secure3d>NO</secure3d>
                                    <trxtype>sale</trxtype>
                                    <email>ronald.magleo@paynamics.net</email>
                                    <phone>3308772</phone>
                                    <mobile>09178134828</mobile>
                                    <client_ip>122.55.82.180</client_ip>
                                    <amount>150.00</amount>
                                    <currency>USD</currency>
                                    <mlogo_url>https://testpti.payserv.net/paytravel/images/paytravel_logo.png</mlogo_url>
                                    <pmethod></pmethod>
                                    <signature>460b5fb967c66b637579ea454384fa9f742b761a9ba4def09f96c724929764d96f9d562020f875c2b0c4cffd0d59575646ce238a8c2f56dd411dc39c697aea2b</signature>
                                        </application>
                                    </saleResult>
                                </saleResponse>
                            </soap:Body>
                        </soap:Envelope>');
        $reservation = $this->reservations_model->get_reservation($ref_no);
    }
}

<?php
if (isset($_REQUEST['cal'])) {
$a=$_REQUEST['cal'];
$aa=explode("#",$a);
$amt[0]=250000;
$amt[1]=500000;
$amt[2]=1000000;
$amt[3]=9999999999;
$trate[0]=0;
$trate[1]=5;
$trate[2]=20;
$trate[3]=30;
$c80=floatval($aa[11]);
if ($c80 > 150000) $c80=150000;
$zerotax[1]=250000;
$zerotax[2]=250000;
$zerotax[3]=300000;
$zerotax[4]=500000;
$notax = $zerotax[$aa[3]];
$sal=floatval($aa[6]) + floatval($aa[7]) + floatval($aa[8]) + floatval($aa[9]) - $c80 - floatval($aa[12]) + floatval($aa[13]);
$sptax1=floatval($aa[14]) * .15;
$sptax2=floatval($aa[15]) * .20;
$sptax3=floatval($aa[16]) * .10;
$sptax4=floatval($aa[17]) * .30;
$spinc=floatval($aa[14]) + floatval($aa[15]) + floatval($aa[16]) + floatval($aa[17]);
$sptax = $sptax1 + $sptax2 + $sptax3 + $sptax4;
$agri=$aa[10];
if ($agri=="") $agri=0;
$taxinc = $sal;
$n=sizeof($amt) - 1;
$tax=0;
$sal=$sal + $agri;
$notax = $notax + $agri;
for ($i=$n;$i>0;$i--) {
$nextamt = $amt[$i - 1] ;
if ($notax > $nextamt) {$nextamt=$notax;}
$sal1=$sal -$nextamt;
if ($sal1 > 0) {
$tax1 = $sal1 * $trate[$i] / 100;
$tax = $tax + $tax1;
$sal = $amt[$i-1];
}}

if ($tax<0) $tax=0;
if ($taxinc <= 500000) {
$ptax=$tax - 12500;
if ($ptax < 0) $ptax = 0;
} else {$ptax = $tax;}
$ptax = $ptax + $sptax1 + $sptax2 + $sptax3 + $sptax4;
$cess = $ptax * .04;
$tot = $ptax + $cess;
echo $taxinc."#".$tax."#".$ptax."#".$cess."#".$tot."#".$spinc."#".$sptax;exit;
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>KRIS INCOME TAX CALCULATOR INDIA</title>
<link rel="stylesheet" href="kris.css">
<script src='kris.js'></script>
</head>
<body>
<form>
<?php
echo "<table class='tablem'>";
echo "<tr bgcolor='#F5F5F5'><td class='threefr'>Assesment Year</td><td class='onefr'><select  class='inpbox2' id='ayear' autofocus ><option></option><option value=1>2023-24</option></select></td>";
echo "<td class='threefr'>Tax Payer</td><td class='onefr'><select  class='inpbox2' id='tpayer'><option value=0></option><option value=1>INDIVIDUAL</option></select></td>";
echo "<tr><td class='threefr'>Whether opting for taxation under Section 115BAC?</td><td class='onefr'><select  class='inpboxl' id='schm'><option value=0></option>";
//echo "<option value=1>YES</option>";
echo "<option value=2>NO</option></select></td>";
echo "<td class='threefr'>Select Male/ Female/ Senior Citizen</td><td class='onefr'><select  class='inpboxl' id='gender'><option value=0></option><option value=1>MALE</option><option value=2>FEMALE</option><option value=3>SENIOR CITIZEN</option><option value=4>SUPER SENIOR CITYZEN</option></select></td>";
echo "<tr bgcolor='#F5F5F5'><td class='threefr'>Resindential Status</td><td class='onefr'><select id='rsstat' class='inpbox2'><option value=0></option><option value=1>RESIDENT</option></select></td>";
echo "<td class='threefr'>Date of birth</td><td class='onefr'><input type='date' id='dob' class='inpbox2'/></td>";
echo "<tr><td class='threefr'>Salary income (Excluding standanrd ded,Prof tax etc.)</td><td class='onefr'><input type='text' id='sal' class='inpbox' onfocusout=indformat('sal'); /></td>";
echo "<td class='threefr' onclick='display(1);' style='cursor: pointer;'>Income from house property (Click to add details)</td><td class='disbox' onclick='display(1);' id='hinc' style='cursor: pointer;'></td>";

echo "<tr bgcolor='#F5F5F5'><td class='threefr' onclick='display(2);' style='cursor: pointer;'>Capital gains (Click to add details)</td><td class='disbox'  id='captot'  onclick='display(2);'  style='cursor: pointer;'></td>";
echo "<td class='threefr'>Income from other sources(Interest, Commission etc)</td><td class='onefr'><input type='text' id='oincome' class='inpbox3' onfocusout=indformat('oincome'); /></td>";
echo "<tr><td class='threefr' colspan=3>Income from other sources(Winnings from Lottery, Crossword Puzzles, etc 30%)</td><td class='onefr'><input type='text' id='ltincome' class='inpbox' onfocusout=indformat('ltincome'); /></td>";
echo "<tr bgcolor='#F5F5F5'><td class='threefr'>Profits and Gains of Business or Profession (enter profit only)</td><td class='onefr'><input type='text' id='profit' class='inpbox3' onfocusout=indformat('profit'); /></td>";
echo "<td class='threefr'>Agriculture income (For slab purpose only)</td><td class='onefr'><input type='text' id='agri' class='inpbox3' onfocusout=indformat('agri'); /></td>";
echo "<tr><td class='threefr'>Deductions 80C</td><td class='onefr'><input type='text' id='c80' class='inpbox' onfocusout=indformat('c80'); /></td>";
echo "<td class='threefr' onclick='display(3);' style='cursor: pointer;'>Deductions Others than 80C (Click to add details)</td><td class='disbox' id='d80' onclick='display(3);'  style='cursor: pointer;'></td>";

echo "<tr bgcolor='#F5F5F5'><td  class='threefr' colspan=4 id='tdet'>Tax Details</td>";
echo "<tr><td class='threefr'>Net Taxable income at normal rate</td><td class='disbox' id='netinc'></td>";
echo "<td class='threefr'>Calculated Income tax at normal rate</td><td class='disbox' id='ctax'></td>";
echo "<tr><td class='threefr'>Net Taxable income at special rate</td><td class='disbox' id='spinc'></td>";
echo "<td class='threefr'>Calculated Income tax at special rate</td><td class='disbox' id='sptax'></td>";
echo "<tr><td class='threefr'>Income tax payable</td><td class='disbox' id='ptax'></td>";
echo "<td class='threefr'>Surcharge</td><td class='disbox' id='surc'></td>";
echo "<tr><td class='threefr'>Health and Educational Cess</td><td class='disbox' id='edu'></td>";
echo "<td class='threefr'>Total Tax liability</td><td class='disbox' id='tot'></td>";
echo "<tr><td colspan=4><input type='button' onclick='calculate();' value='Calculate' /></td>";
echo "</table>";

echo "<div id='house' style='display:none;'>";
echo "<table class='tablem'>";
echo "<tr><td class='threefr'>Interest paid self occupied house</td><td class='onefr'><input type='text' id='ipself' class='inpbox' onchange=housing('ipself'); /></td>";
echo "<td class='threefr'>Annual Letable Value/Rent Received or Receivable</td><td class='onefr'><input type='text' id='hrent' class='inpbox'  onchange=housing('hrent'); /></td>";
echo "<tr><td class='threefr'>Less: Municipal Taxes Paid During the Year</td><td class='onefr'><input type='text' id='htax' class='inpbox' onchange=housing('htax');  /></td>";
echo "<td class='threefr'>Less:Unrealized Rent</td><td class='onefr'><input type='text' id='rpend' class='inpbox' onchange=housing('rpend');  /></td>";
echo "<tr><td class='threefr'>Net Annual Value</td><td class='disbox' id='hnet'></td>";
echo "<td class='threefr'>Standard Deduction @ 30% of Net Annual Value</td><td class='disbox' id='hstd'></td>";
echo "<tr><td class='threefr'>Interest on Housing Loan (Let out house)</td><td class='onefr'><input type='text'  id='iplet' class='inpbox' onchange=housing('iplet');  /></td>";
echo "<td class='threefr'>Income from Let-out House Property</td><td class='disbox' id='inclet'></td>";
echo "<tr><td colspan=4><input type='button' onclick='hide(1);' value='Hide' /></td>";
echo "</table>";
echo "</div>";

echo "<div id='capital' style='display:none;'>";
echo "<table class='tablem'>";
echo "<tr><td class='long'>Short Term Capital GainS (Other than covered under section 111A)</td><td class='onefr'><input type='text' id='cap1' class='inpbox' onchange=capital('cap1'); /></td>";
echo "<tr><td class='long'>Short Term Capital GainS (Covered under section 111A tax @ 15%)</td><td class='onefr'><input type='text' id='cap2' class='inpbox'  onchange=capital('cap2'); /></td>";
echo "<tr><td class='long'>Long Term Capital Gains (Charged to tax @ 20%)</td><td class='onefr'><input type='text' id='cap3' class='inpbox' onchange=capital('cap3');  /></td>";
echo "<tr><td class='long'>Long Term Capital Gains (Charged to tax @ 10%)</td><td class='onefr'><input type='text' id='cap4' class='inpbox' onchange=capital('cap4');  /></td>";
echo "<tr><td colspan=2><input type='button' onclick='hide(2);' value='Hide' /></td>";
echo "</table>";
echo "</div>";

echo "<div id='ded80' style='display:none;'>";
echo "<table class='tablem'>";
echo "<tr><td class='long'>Additional contribution towards NPS [u/s 80CCD(1B)] (Maximum 50000)</td><td class='onefr'><input type='text' id='d2' class='inpbox'  onchange=ded80('d2',50000); /></td>";
echo "<tr><td class='long'>Employer's contribution toward NPS (u/s 80CCD) (10 % Basic + DA)</td><td class='onefr'><input type='text' id='d3' class='inpbox' onchange=ded80('d3',999999999);  /></td>";
echo "<tr><td class='long'>Long-term infrastructure bonds (u/s 80CCF) (Maximum 20000)</td><td class='onefr'><input type='text' id='d4' class='inpbox' onchange=ded80('d4',20000);  /></td>";
echo "<tr><td class='long'>50 % of Investment under equity saving scheme (u/s 80CCG) (Maximum 25000)</td><td class='onefr'><input type='text'  id='d5' class='inpbox' onchange=ded80('d5',25000);  /></td>";
echo "<tr><td class='long'>Medi-claim premium (u/s 80D) (25T to 1.05L)</td><td class='onefr'><input type='text' id='d6' class='inpbox' onchange=ded80('d6',105000); /></td>";
echo "<tr><td class='long'>Actual payment towards medical treatment (u/s 80DDB) (Specified deseases maximum 100000)</td><td class='onefr'><input type='text' id='d7' class='inpbox'  onchange=ded80('d7',100000); /></td>";
echo "<tr><td class='long'>Donations (u/s 80G)</td><td class='onefr'><input type='text' id='d8' class='inpbox' onchange=ded80('d8',9999999999);  /></td>";
echo "<tr><td class='long'>Deduction for maintenance / medical treatment of dependent (Differently abled) (u/s 80DD) (Maximum 125000)</td><td class='onefr'><input type='text' id='d9' class='inpbox' onchange=ded80('d9',125000);  /></td>";
echo "<tr><td class='long'>Interest on loan for higher education (u/s 80E)</td><td class='onefr'><input type='text'  id='d10' class='inpbox' onchange=ded80('d10',9999999999);  /></td>";
echo "<tr><td class='long'>Interest on loan taken for Residential House sanctioned between 01.04.2016 and 31.03.2017  (u/s 80EE)</td><td class='onefr'><input type='text' id='d11' class='inpbox'  onchange=ded80('d11',50000); /></td>";
echo "<tr><td class='long'>Deduction in case of a person with disability (u/s 80U) (75000 to 125000)</td><td class='onefr'><input type='text' id='d12' class='inpbox' onchange=ded80('d12',125000);  /></td>";
echo "<tr><td class='long'>Interest on deposits in saving account (u/s 80TTA) (Maximum 10000)</td><td class='onefr'><input type='text' id='d13' class='inpbox' onchange=ded80('d13',10000);  /></td>";
echo "<tr><td colspan=4><input type='button' onclick='hide(3);' value='Hide' /></td>";
echo "</table>";
echo "</div>";
?>
</form></body></html>
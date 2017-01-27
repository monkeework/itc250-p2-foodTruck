<?php
/**
 * index.php - based on demo_postback_nohtml.php is a single page web application that allows us to request and view
 * a customer's food truck order
 *
 * This version uses no HTML directly so we can code collapse more efficiently
 *
 * This page is a model on which to demonstrate fundamentals of single page, postback
 * web applications.
 *
 * Any number of additional steps or processes can be added by adding keywords to the switch
 * statement and identifying a hidden form field in the previous step's form:
 *
 *<code>
 * <input type="hidden" name="act" value="next" />
 *</code>
 *
 * The above live of code shows the parameter "act" being loaded with the value "next" which would be the
 * unique identifier for the next step of a multi-step process
 *
 * @package ITC281
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 1.1 2011/10/11
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @todo finish instruction sheet
 * @todo add more complicated checkbox & radio button examples
 */

# '../' works for a sub-folder.  use './' for the root
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials

/*
 * selected optimal config setup for food truck project
 **/

$config->metaDescription = 'itc250 Project 2 - Food Truck.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = '<b>Food Truck</b>'; #goes inside header
$config->copyright = ''; #goes inside footer


//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}



echo '	<h3 align="center">Project 2 :: Food Truck</h3>
	<br /<br />
	<img class="img-responsive center-block" src="./_img/icon-foodtruck00.jpg" alt="itc 250 Food Truck Project #2" />
	<br /><br />';




switch ($myAction)
{//check 'act' for type of process
	case "display": # 2)Display user's name!
		 show_order();
		 break;
	default: # 1)Ask user to enter their name
		 get_order();
}

function get_order()
{# shows form so user can enter their name.  Initial scenario
	get_header(); #defaults to header_inc.php


	echo '
	<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.YourName,"Please Enter Your Name")){return false;}
			return true;//if all is passed, submit!
		}
	</script>

	<form class="form-horizontal">
		<fieldset>

		<!--
			This has been styled using the Twitter Bootsrap API
			I have added extra spaces between sections to make more readable

			each input is labelled so you know what you are dealing

			@TODO remove visual input indentifications from final submission
		-->



		<!-- Form Orders -->
		<!-- PIZZA -->
		<!-- Select Basic -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="pizzaType">PIZZA (Select Basic)</label>
			<div class="col-md-4">
				<select id="selectbasic" name="pizzaType" class="form-control">
					<option value="1">Cheese   - $7.95</option>
					<option value="2">Hawain   - $9.95</option>
					<option value="3">Meetball - $11.95</option>
					<option value="4">Sausage  - $13.95</option>
					<option value="5">Cheese   - $7.95 + $.50 per topping</option>
				</select>
			</div>
		</div>

		<!-- Multiple Checkboxes -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="checkboxes">Toppings (Multiple Checkboxes)</label>

			<!-- BEGIN radion btns Left -->
			<div class="col-md-2">
				<div class="checkbox">
					<label for="checkboxes-1">
						<input type="checkbox" name="checkboxes" id="pizzaToppings-1" value="1">
						Anchovies
					</label>
				</div>

				<div class="checkbox">
					<label for="checkboxes-2">
						<input type="checkbox" name="checkboxes" id="pizzaToppings-2" value="2">
						Cheese
					</label>
				</div>

				<div class="checkbox">
					<label for="checkboxes-3">
						<input type="checkbox" name="checkboxes" id="pizzaToppings-3" value="1">
						Pinapple
					</label>
				</div>

				<div class="checkbox">
					<label for="checkboxes-4">
						<input type="checkbox" name="checkboxes" id="pizzaToppings-4" value="2">
						Sauce
					</label>
				</div>
			</div><!-- END radion btns Left -->

			<!-- BEGIN radion btns right -->
			<div class="col-md-2">
				<div class="checkbox">
					<label for="checkboxes-5">
						<input type="checkbox" name="checkboxes" id="pizzaToppings-5" value="1">
						Meetballs
					</label>
				</div>

				<div class="checkbox">
					<label for="checkboxes-6">
						<input type="checkbox" name="checkboxes" id="pizzaToppings-6" value="2">
						Sausage
					</label>
				</div>

				<div class="checkbox">
					<label for="checkboxes-7">
						<input type="checkbox" name="checkboxes" id="pizzaToppings-7" value="1">
						Pepperoine
					</label>
				</div>

				<div class="checkbox">
					<label for="checkboxes-8">
						<input type="checkbox" name="checkboxes" id="pizzaToppings-8" value="2">
						Sauce
					</label>
				</div>
			</div><!-- END radion btns right -->
		</div>

		<!-- Quantity - Numeric input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="textinput">Number of Pizzas (Numeric Input)</label>
			<div class="col-md-4">
				<input id="numOfPizza" name="numOfPizza" type="number" min="1" max="20" placeholder="Enter the number of Pizzas you want" class="form-control input-md">
			<p class="help-block"><a href="cancelPizza" "cancelPizza">Cancel Pizza</a></p>
			</div>
		</div>
		<!-- END pizza -->



		<br /><br />



		<!-- BEVERAGES -->
		<!-- Select Basic -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="bevType">Beverages (Select Basic)</label>
			<div class="col-md-4">
				<select id="selectbasic" name="bevType" class="form-control">

					<option value="1">Cherry Pepsi</option>
					<option value="2">Cream Soda</option>
					<option value="3">Pepsi</option>
					<option value="4">Diet Pepsi</option>
					<option value="5">Sasparilla</option>
					<option value="6">Rootbeer</option>
					<option value="7">Vanilla Pepsi</option>
					<option value="8">Watter (Aquafina)</option>
				</select>
			</div>
		</div>

		<!-- Multiple Checkboxes -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="beverages">Multiple Checkboxes</label>

			<!-- BEGIN radion btns Left -->
			<div class="col-md-2">
				<div class="checkbox">
					<label for="checkboxes-1">
						<input type="checkbox" name="ice" id="beverages-1" value="1">
						ice
					</label>
				</div>
			</div><!-- END radion btns Left -->

			<!-- BEGIN radion btns right -->
			<div class="col-md-2">
				<div class="checkbox">
					<label for="ice-1">
						<input type="checkbox" name="no icee" id="beverages-2" value="2">
						No Ice
					</label>
				</div>
			</div>
		</div>

		<!-- Quantity - Numeric input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="numOfBeverages">Number of Beverages</label>
			<div class="col-md-4">
				<input id="numOfPizza" name="numOfBeverages" type="number" min="1" max="20" placeholder="Enter the number of drinks you want" class="form-control input-md">
			</div>
		</div>
		<!-- END Beverages -->



		<br /><br /><br />



		<!-- BEGIN sides -->
		<!-- Select Multiple -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="selectmultiple">Sides (Select Multiple)</label>
			<div class="col-md-4">
				<select id="selectmultiple" name="selectSides" class="form-control" multiple="multiple">
					<option value="1">Buffaloo Wings</option>
					<option value="1">Catnip</option>
					<option value="2">Chicken Wings</option>
					<option value="3">Cookie</option>
					<option value="4">Ceasar Salad</option>
					<option value="5">Cob Salad</option>
					<option value="6">Fench Fries</option>
					<option value="7">Onion Rings</option>
					<option value="8">Option two</option>
				</select>
			</div>
		</div><!-- END sides -->



		<br /><br />



		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="textinput">Order Name</label>
			<div class="col-md-4">
			<input id="orderEmail" name="textinput" type="email" placeholder="Enter your email to place order" class="form-control input-md">
			<span class="help-block pull-right">cancel order</span>
			</div>
		</div>
		<!-- END item three -->



		<!-- submit order + hidden act field -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="selectmultiple"></label>
			<div class="col-md-4">
				<input  class="btn btn-primary pull-right"  type="submit" value="Place Order">

				<!-- if act == $_POST show order, else show form -->
				<input type="hidden" name="act" value="display" />

			</div>
		</div>



		</fieldset>
	</form>
	';








	get_footer(); #defaults to footer_inc.php
}

function show_order()
{#form submits here we show entered name
	get_header(); #defaults to footer_inc.php
	if(!isset($_POST['YourName']) || $_POST['YourName'] == '')
	{//data must be sent
		feedback("No form data submitted"); #will feedback to submitting page via session variable
		myRedirect(THIS_PAGE);
	}

	if(!ctype_alnum($_POST['YourName']))
	{//data must be alphanumeric only
		feedback("Only letters and numbers are allowed.  Please re-enter your name."); #will feedback to submitting page via session variable
		myRedirect(THIS_PAGE);
	}

	$myName = strip_tags($_POST['YourName']);# here's where we can strip out unwanted data



	echo '<h3 align="center"> Will execute once order form agreed on</h3>';


	echo '<h3 align="center">' . smartTitle() . '</h3>';
	echo '<p align="center">Your name is <b>' . $myName . '</b>!</p>';
	echo '<p align="center"><a href="' . THIS_PAGE . '">RESET</a></p>';
	get_footer(); #defaults to footer_inc.php
}
?>

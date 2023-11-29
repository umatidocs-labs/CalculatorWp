=== calculatorwp ===

Contributors: WPlendev, freemius
Tags: calculator, loan, mortgagemortgage calculator, responsive mortgage calculator, loan application, loan management system, mortgage calculator, affiliate, loan affiliate marketing, responsive, loan company, leadsgate
Donate link:
Requires at least: 4.0
Tested up to: 5.5
Stable tag: trunk
Requires PHP: 5.4
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
A Complete Marketing tool for Lenders on WordPress.

== Description ==
A Complete Marketing tool for Lenders on WordPress. It will help you Sell, Cross-sell and Upsell Loan Products. It's Ideal for; Mortgage lenders, Mortgage brokers, Lending fintech companies, Microfinance and Banks.

The new calculatorwp has everything you will need to run a lending website. It helps the borrower;
	+ Find the right loan easily,
	+ Apply for a loan,
	+ and follow up on a loan application.

<strong>Get started</strong>

== Installation ==
INSTALLATION
This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the \'Plugins\' screen in WordPress
3. Click "save changes" on the "Permalink Settings" page
4. Create a loan product on Simplemortgage
5. Display loan product using short code [calculatorwp product=1] (Product id will be at the top after you create loan product)
Other shortcodes:
Loan Calculator: [calculatorwp product=1]
Login:  [sl_user_gate]

CREATE LOAN PRODUCT
On activation, you will be automatically be redirected to loan product creations, alternatively you will find it at calculatorwp->loan product (for the customizable form, use gravity form 2.4 or later)

IMPORTANT: After creating loan product, you need to go to Settings > Permalinks and click “save”. This flushes the WordPress rewrite rules. For performance reasons, the rewrite rules are only flushed either when the plugin is activated or when the Permalinks are saved. So, if you are developing with the plugin activated and adding controller routes as you go, you need to use this approach to flush the rewrite rules and use your new URL endpoints.

POST IT ON FRONTEND
Use the shortcode [calculatorwp product=1] where 1 is loan product id that you have created.

SUBMIT LOAN APPLICATION
Go to where you have put the form and fill  a loan application.

VIEW LOAN SUBMISSION
On the admin section, navigate to calculatorwp->loan applications and you will see all the latest application, from here you will be able to manage all the loan applications.

DO A DRIP CAMPAIGN TO FOLLOWUP ON BORROWERS AND GET THEM ACTIVE
You can now send new loan applicants to a drip marketing list on your best platform e.g. mailchimp, active campaign and CRM etc.

Ticket
On the frontend, the borrower is able to create a ticket and chat with the lender

Gravity form
To add additional forms on the loan application form, download gravity form at https://github.com/wp-premium/gravityforms/archive/master.zip create a goal form and secondary form on gravity plugin.
On calculatorwp->loan product, select the loan product on the and under gravity form field there is a 'goal form' dropdown section and 'secondary form' dropdown section. NB: you need to be a premium user to use this feature.

== Frequently Asked Questions ==
= I am getting a 404 when I add a new route =

You need to go to Settings > Permalinks and click “save”. This flushes the WordPress rewrite rules. For performance reasons, the rewrite rules are only flushed either when the plugin is activated or when the Permalinks are saved. So, if you are developing with the plugin activated and adding controller routes as you go, you need to use this approach to flush the rewrite rules and use your new URL endpoints.

= Does the plugin use a 3rd party service? =

No the plugin is a stand-alone and does not require you to create an account in a third party website.

= Does the plugin require the client side JavaScript to be active. =

Yes

== Screenshots ==
1. image1.png
2. image2.png
3. image3.png

== Changelog ==
No changes

== Upgrade Notice ==
Get more out of calculatorwp

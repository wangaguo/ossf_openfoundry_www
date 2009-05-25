<?php

class mtLanguage {
	var $TITLE = "Directory";
	var $CATEGORY = "Category";
	var $CATEGORIES = "Categories";
	var $FEATURED_CATEGORIES = "Featured Categories";
	var $LISTINGS = "Listings";
	var $LISTING = "Listing";
	var $ERROR = "Error";
	var $REVIEWS = "Reviews";
	var $REVIEW = "Review";
	var $RATINGS = "Ratings";
	var $RECOMMEND = "Recommend";
	var $MAP = "Map";
	var $CANCEL = "Cancel";
	var $APPROVED = "Approved";
	var $EMPTY_CATEGORY = "<br /><center>There is no Listings in this category.</center>";
	var $ROOT = "Directory";
	var $ARROW = " > ";
	var $DELETE = "Delete";
	var $EDIT = "Edit";
	var $ADD = "Add";
	var $NEVER = "Never";
	var $BROWSE = "All Categories";
	var $HOME = "Home";
	var $GUEST = "Guest";

	var $SHOW = "Show";
	var $HITS = "Views";
	var $RATING = "Rating";
	var $VOTES = "Votes";
	var $VOTE = "vote";
	var $VISIT = "Visit";
	var $VISITED = "Visited";
	var $FAVOURED = "Favoured";
	var $ADDED = "Date Added";
	var $MODIFIED = 'Updated ';
	var $MINUTE_AGO = '%s minute ago';
	var $MINUTES_AGO = '%s minutes ago';
	var $HOUR_AGO = '%s hour ago';
	var $HOURS_AGO = '%s hours ago';
	var $DAY_AGO = '%s day ago';
	var $DAYS_AGO = '%s days ago';
	var $MODIFIED2 = "Updated";
	var $MORE_DETAILS = "More Details";
	var $ADDRESS = "Address";
	var $TELEPHONE = "Telephone";
	var $FAX = "Fax";
	var $EMAIL = "E-mail";
	var $WEBSITE = "Website";
	var $REVIEW_TITLE = "Title";
	var $SEARCH = "Search";
	var $RESET = "Reset";
	var $NUMBER = "number";
	var $YES = "Yes";
	var $NO = "No";
	var $FREE = 'Free';

	var $AVERAGE_VISITOR_RATING = "Average Visitor Rating";
	var $NUMBER_OF_RATINGS = "Number of ratings";
	var $OUT_OF_FIVE = "Out of 5";
	var $PRINT = "Print";
	var $BACK_TO_LISTING = "Back to Listing";

	var $NON_REGISTERED_USER = "Non-registered user";
	var $NOT_SPECIFIED = "Not specified";

	/* My Listing */
	var $MY_PAGE = "My Page";
	var $DELETE_LISTING = "Delete";
	var $YOU_DO_NOT_HAVE_ANY_LISTINGS = "You do not have any listings.";
	var $YOU_DO_NOT_HAVE_ANY_REVIEWS = "You do not have any reviews.";
	var $YOU_DO_NOT_HAVE_ANY_FAVOURITES = "You do not have any favourites.";

	/* Category - General */
	var $SELECT_CATEGORY = "Select category";
	var $ALL_CATEGORIES = "All Categories";
	var $MORE_CATEGORIES = "More categories: ";
	var $THERE_ARE_NO_CAT_OR_LISTINGS = "There are no categories or listings that start with <b>%s</b>";
	var $RELATED_CATEGORIES = "Related Categories";
	var $RELATED_CATEGORIES2 = "Related Cats";

	/* Listing - General */
	var $LINK_NEW = "New!";
	var $LINK_POPULAR = "Popular";
	var $LINK_FEATURED = "Featured";
	var $FEATURED_LISTING = "Featured Listing";
	var $FEATURED_LISTING2 = "Featured Listing: ";
	var $THERE_ARE_X_LISTING = "There are %s Listings in this Category.";
	var $LISTING_INFORMATION = "Listing Information";
	var $GALLERY2 = "Gallery: %s";
	var $BACK_TO_GALLERY = 'Back to gallery';
	var $VIEW_GALLERY = 'View gallery';
	var $NEXT_IMAGE = 'Next &gt;';
	var $PREVIOUS_IMAGE = '&lt; Previous';
	
	/* Modules */
	var $EDIT_LISTING = "Edit Listing";
	var $SUBMIT_LISTING = "Submit";
	var $POPULAR_LISTING = "Most Popular Listings";
	var $POPULAR_LISTING2 = "Most Popular Listings: ";
	var $NEW_LISTING = "New Listings";
	var $NEW_LISTING2 = "New Listings: ";
	var $MOST_FAVOURED_LISTINGS = "Most Favoured Listings";
	var $MOST_FAVOURED_LISTINGS2 = "Most Favoured Listings:";
	var $RECENTLY_UPDATED_LISTING = "Recently Updated Listings";
	var $RECENTLY_UPDATED_LISTING2 = "Recently Updated Listings: ";
	var $MOST_RATED_LISTING = "Most Rated Listings";
	var $MOST_RATED_LISTING2 = "Most Rated Listings: ";
	var $TOP_RATED_LISTING = "Top Rated Listings";
	var $TOP_RATED_LISTING2 = "Top Rated Listings: ";
	var $MOST_REVIEWED_LISTING = "Most Reviewed Listings";
	var $MOST_REVIEWED_LISTING2 = "Most Reviewed Listings: ";
	var $LIST_ALPHA_BY_LISTINGS_AND_CATS = "List Categories and Listings by %s: %s";
	var $IN = "in";

	/* Contact Owner */
	var $CONTACT2 = "Contact: ";
	var $CONTACT_OWNER = "Contact Owner";
	var $CONTACT_SUBJECT = "Enquiries from %s: %s";
	var $CONTACT_MESSAGE = "This is a message sent by %s <%s> from a listing named - %s. The listing URL is:\n%s\n\n%s";
	var $CONTACT_EMAIL_HAVE_BEEN_SENT = "Your email has been successfully sent to owner";
	var $PLEASE_LOGIN_BEFORE_CONTACT = "You need to login first before you can contact the owner.";
	
	/* All Owner's Listing */
	var $ALL_OWNERS_LISTING = "Owner's listing";
	var $THIS_USER_DO_NOT_HAVE_ANY_LISTINGS = "This user do not have any listings.";

	var $OWNERS_LISTING = "Owner's Listing";
	var $LISTING_BY = "Listings by %s";

	/* Report Listing */
	var $REPORT = "Report";
	var $REPORTS = "Reports";
	var $REPORT2 = "Report: ";
	var $REPORT_LISTING = "Report Listing";
	var $REPORT_PROBLEM = "Reason";
	var $REPORT_PROBLEM_1 = "Broken links";
	var $REPORT_PROBLEM_2 = "Inaccurate information";
	var $REPORT_PROBLEM_3 = "This listing is in the wrong category";
	var $REPORT_PROBLEM_4 = "Others (Please specify below)";
	var $REPORT_HAVE_BEEN_SENT = "Thank you for your report. We will attend to the problem as soon as possible.";
	var $REPORT_EMAIL = "There is a report from a user. Please review the listing. You can view this listing at:\n\n%s\n\n------------------------------\nListing Details:\n------------------------------\n\nName: %s\nProblem: %s\nListing ID: %s\nComment:\n\n%s";

	/* Report Review */
	var $PLEASE_LOGIN_BEFORE_REPORT = "You need to login first before you can report a listing.";
	var $REPORT_REVIEW_EMAIL = "There is a report from a user on a review. You can view this listing and review at:\n\n%s\n\n------------------------------\nReport Message:\n------------------------------\nSubmitter: %s\n\n%s\n\n------------------------------\nReview Details:\n------------------------------\nTitle: %s\nListing Name: %s\n\n%s";
	var $PLEASE_FILL_IN_REPLY = "Please enter your reply before submitting";

	/* Claim Listing */
	var $CLAIM = "Claim";
	var $CLAIMS = "Claims";
	var $CLAIM_LISTING = "Claim Listing";
	var $PLEASE_LOGIN_BEFORE_CLAIM = "You need to login first before you can claim a listing";
	var $CLAIM_EMAIL = "There is a claim from a user. Please review the listing. You can view this listing at:\n\n%s\n\n------------------------------\nListing Details:\n------------------------------\n\nName: %s\nListing ID: %s\nComment:\n\n%s";
	var $CLAIM_HAVE_BEEN_SENT = "Thank you. We will attend to the claim as soon as possible.";

	/* Reviews */
	var $REVIEWED_BY = "by";
	var $REVIEWS_BY = "Reviews by %s";
	var $WRITE_REVIEW = "Submit review";
	var $PLEASE_LOGIN_BEFORE_REVIEW = "You need to login first before you can write any reviews.";
	var $YOU_RE_NOT_ALLOWED_TO_REVIEW_OWN_LISTING = "You're not allowed to review own listing.";
	var $YOU_CAN_ONLY_REVIEW_ONCE = "You can only review once for every listing.";
	var $YOU_ARE_NOT_ALLOWED_TO_REVIEW = "You are not allowed to review.";
	var $PLEASE_FILL_IN_REVIEW = "Please enter your review before submitting.";
	var $PLEASE_FILL_IN_TITLE = "Please enter the title before submitting.";
	var $PLEASE_FILL_IN_RATING = "Please enter the rating.";
	var $ADD_REVIEW = "Submit Review";
	var $REVIEW_HAVE_BEEN_SUCCESSFULLY_ADDED = "Your review has been successfully added";
	var $BE_THE_FIRST_TO_REVIEW = "Be the first to review this listing!";
	var $REVIEW_WILL_BE_REVIEWED = "Thank you for your submission. Your review will be reviewed shortly by our Administrator and added to our directory once it is approved.";
	var $PEOPLE_FIND_THIS_REVIEW_HELPFUL = "%s of %s people found this review helpful";
	var $THIS_USER_DO_NOT_HAVE_ANY_REVIEWS = "This user do not have any reviews.";

	/* Ratings */
	var $SELECT_YOUR_RATING = "Select your rating";
	var $YOU_CAN_ONLY_RATE_ONCE = "You can only rate once for every Listing.";
	var $PLEASE_LOGIN_BEFORE_RATE = "You need to login first before you can rate.";
	var $YOU_ARE_NOT_ALLOWED_TO_RATE = "You are not allowed to rate.";
	var $YOU_RE_NOT_ALLOWED_TO_RATE_OWN_LISTING = "You're not allowed to rate own listing.";
	var $PLEASE_SELECT_A_RATING = "Please select a rating";
	var $RATING_HAVE_BEEN_SUCCESSFULLY_ADDED = "Your rating has been successfully added.";
	var $THANKS_FOR_RATING = "Thanks for rating!";
	var $RATE_THIS_LISTING = "Rate this listing";
	var $RATE = "Rate: ";
	var $ADD_RATING = "Add Rating";
	var $RATING_5 = "Excellent!";
	var $RATING_4 = "Good";
	var $RATING_3 = "Average";
	var $RATING_2 = "Fair";
	var $RATING_1 = "Very Poor";
	
	/* Favourites */
	var $FAVOURITES_BY = "Favourites by %s";
	var $ADDED_AS_FAVOURITE = "Added as Favourite!";
	var $FAVOURITE_REMOVED = "Favourite Removed";
	var $FAVOURITES = "Favourites";
	var $THIS_USER_DO_NOT_HAVE_ANY_FAVOURITES = "This user do not have any favourite listings.";
	var $REMOVE_FAVOURITE = 'Remove Favourite';
	var $ADD_AS_FAVOURITE = 'Add as Favourite';
	
	/* Review voting */
	var $YOU_CAN_ONLY_RATE_ONCE_FOR_EVERY_REVIEW = "You have already vote for this review.";
	var $REVIEW_RATING_HAVE_BEEN_SUCCESSFULLY_ADDED = "Thank you for your vote. Your vote has been successfully added to the review.";
	var $PLEASE_LOGIN_BEFORE_VOTE_REVIEW = "You need to login first before you can vote on reviews.";
	var $WAS_THIS_REVIEW_HELPFUL = "Was this review helpful to you?";
	var $THANKS_FOR_YOUR_VOTE = "Thanks for your vote!";
	var $REPORT_REVIEW = "Report";
	var $REVIEWS_REPORTS = "Reviews' reports";

	/* Reply Review */
	var $REPLY_REVIEW = "Reply";
	var $OWNERS_REPLY = "Owner's reply";
	var $ADMIN_NEW_REVIEW_REPLY_MSG_WAITING_APPROVAL = "This is a review reply from an owner. Please review for approval:\n\n------------------------------\nReply Message:\n------------------------------\nOwner: %s\n\n%s\n\n------------------------------\nReview Details:\n------------------------------\nTitle: %s\nListing Name: %s\n\n%s";
	var $ADMIN_NEW_REVIEW_REPLY_MSG_APPROVED = "\nA review reply has been added to your website.\n\nPlease review for approval:\n\n------------------------------\nReply Message:\n------------------------------\nOwner: %s\n\n%s\n\n------------------------------\nReview Details:\n------------------------------\n\nTitle: %s\nAuthor: %s (%s)\nE-mail: %s\n\n%s";
	var $NEW_REVIEW_REPLY_EMAIL_SUBJECT_WAITING_APPROVAL = "New reply on review (pending approval) - %s";
	var $NEW_REVIEW_REPLY_EMAIL_SUBJECT_APPROVED = "New reply on review - %s";
	var $REPLY_REVIEW_HAVE_BEEN_SUCCESSFULLY_ADDED = "Your reply has been successfully added";
	var $REPLY_REVIEW_WILL_BE_REVIEWED = "Thank you for your submission. Your reply will be reviewed shortly by our Administrator and added to the review once it is approved.";
	var $OWNERS_REPLIES = "Owners' replies";
	var $YOU_CAN_ONLY_REPLY_A_REVIEW_ONCE = "You have already sent your reply to this review.";
	var $REPLY_REVIEW_HAVE_BEEN_SENT = "Thank you for your report. We will attend to the problem as soon as possible.";

	/* Recommend to friends */
	var $RECOMMEND_LISTING_TO_FRIEND = "Recommend this Listing to your friend";
	var $RECOMMEND_MSG = "The following page from the \"%s\" website has been sent to you by %s (%s).\n\nYou can access it at the following url:\n\n%s";
	var $YOU_MUST_ENTER_VALID_EMAIL = "You must enter your valid e-mail and the valid e-mail to send to.";
	var $RECOMMEND_SUBJECT = "Listing recommended by %s";
	var $RECOMMEND_EMAIL_HAVE_BEEN_SENT = "Your recommendation has been successfully sent to %s";
	var $SEND = "Send";
	var $PLEASE_FILL_IN_THE_FORM = "Please fill in the form before submitting";
	var $PLEASE_LOGIN_BEFORE_RECOMMEND = "You need to login first before you can recommend this Listing to your friend";
	var $FROM = "From";
	var $YOUR_NAME = "Your Name";
	var $YOUR_EMAIL = "Your E-mail";
	var $TO = "To";
	var $FRIENDS_NAME = "Friend's Name";
	var $FRIENDS_EMAIL = "Friend's Email";
	var $MESSAGE = "Message";

	/* Add Listing */
	var $PLEASE_LOGIN_BEFORE_ADDLISTING = "You need to login first before you can add a listing";
	var $PLEASE_FILL_IN_LINK_NAME = "Please fill in the listing name before submitting.";
	var $LISTING_WILL_BE_REVIEWED = "Thank you for your submission. Your Listing will be reviewed shortly by our Administrator and added to our directory once it is approved.";
	var $LISTING_HAVE_BEEN_ADDED = "Thank you for your submission. Your Listing has been added to our directory.";
	var $LISTING_MODIFICATION_WILL_BE_REVIEWED = "Thank you for your submission. Your modification will be reviewed shortly by our Administrator and added to our directory once it is approved.";
	var $LISTING_HAVE_BEEN_UPDATED = "Your Listing has been updated.";
	var $ADD_YOUR_LISTING_HERE = "Add your listing here";
	var $CATS_IN_BRACKETS_DOES_NOT_ACCEPT_NEW_LISTINGS = "* Categories in brackets do not accept new listings.";
	var $PLEASE_COMPLETE_THIS_FIELD = 'Please complete this field: ';
	var $IMAGE_DIRECTORIES_NOT_WRITABLE = 'One of the image directories is not writable. No image(s) is saved or removed.';
	
	/* Add Category */
	var $ADD_CATEGORY = "Add Category";
	var $PARENT_CATEGORY  = "Parent Category";
	var $PLEASE_LOGIN_BEFORE_ADDCATEGORY = "You need to login first before you can add a category";
	var $PLEASE_FILL_IN_CATEGORY_NAME = "Please fill in the category name before adding the category";
	var $CATEGORY_WILL_BE_REVIEWED = "Thank you for your submission. Your category will be reviewed shortly by our Administrator and added to our directory once it is approved.";
	var $CATEGORY_HAVE_BEEN_ADDED = "Thank you for your submission. Your category has been added to our directory.";

	var $CURRENT_CATEGORY = "Current Category";
	var $CHANGE_CATEGORY = "Change Category";
	var $NAME = "Name";
	var $DESCRIPTION = "Description";
	var $IMAGE = "Image";
	var $PRICE = "Price";
	var $LOCATION = "Location";
	var $PRODUCT_DETAILS = "Product Details";
	var $CITY = "City";
	var $STATE = "State";
	var $COUNTRY = "Country";
	var $POSTCODE = "Postcode";

	// Search Result
	var $YOUR_SEARCH_FOR_X_DOES_NOT_RETURN_ANY_RESULT = "Your search for <strong>%s</strong> does not return any result. <a href=\"javascript:window.history.go(-1)\">Please try again</a>.";
	var $YOUR_SEARCH_DOES_NOT_RETURN_ANY_RESULT = "Your search does not return any result. <a href=\"javascript:window.history.go(-1)\">Please try again</a>.";
	var $SEARCH_FOR = "for";
	var $FOUND_CATEGORIES = "Found <b>%d</b> categories for <b>%s</b>";
	var $ADVANCED_SEARCH_REDIRECT1 = "Your search is in progress. You will be redirected to the results page in a moment. Thank you for your patience.";
	var $ADVANCED_SEARCH_REDIRECT2 = "Click here if the browser does not automatically take you to the results page.";

	/* E-mail Notification */

	// New Review
	var $NEW_REVIEW_EMAIL_SUBJECT_WAITING_APPROVAL = "New review (pending approval) - %s";
	var $NEW_REVIEW_EMAIL_SUBJECT_APPROVED = "New review - %s";

	var $ADMIN_NEW_REVIEW_MSG_WAITING_APPROVAL = "\nA review for \"%s\" has been submitted by your website user. Please review for approval.\n\n------------------------------\nReview Details:\n------------------------------\n\nTitle: %s\nAuthor: %s (%s)\nE-mail: %s\n\n%s";
	var $ADMIN_NEW_REVIEW_MSG_APPROVED = "\nA review for \"%s\" has been added to your website.\n\nYou can view the review at this listing:\n\n%s\n\n------------------------------\nReview Details:\n------------------------------\n\nTitle: %s\nAuthor: %s (%s)\nE-mail: %s\n\n%s";

	// New Listing
	var $NEW_LISTING_EMAIL_SUBJECT_WAITING_APPROVAL = "New Listing (pending approval) - %s";
	var $NEW_LISTING_EMAIL_SUBJECT_APPROVED = "New Listing added - %s";
	
	var $NEW_LISTING_EMAIL_MSG_WAITING_APPROVAL = "\nThank you for your submission. Your Listing will be reviewed shortly by our Administrator and added to our directory once it is approved.\n\nYou will be notified by e-mail when the listing is approved.";
	var $NEW_LISTING_EMAIL_MSG_APPROVED = "\nThank you for your submission. Your Listing has been added to our directory.\n\nYou can view this listing at:\n\n%s\n%s\n\n\nThank you,\n%s";

	var $ADMIN_NEW_LISTING_MSG_WAITING_APPROVAL = "\nA listing named \"%s\" has been submitted by your website user. Please review the listing for approval.\n\n------------------------------\nListing Details:\n------------------------------\n\nListing Name: %s\nListing ID: %s\nOwner: %s (%s)\nE-mail: %s";
	var $ADMIN_NEW_LISTING_MSG_APPROVED = "\nA listing named \"%s\" has been added to your website.\n\nYou can view this listing at:\n\n%s\n\n------------------------------\nListing Details:\n------------------------------\n\nListing Name: %s\nListing ID: %s\nOwner: %s (%s)\nE-mail: %s";

	// Modify Listing
	var $MODIFY_LISTING_EMAIL_SUBJECT_WAITING_APPROVAL = "Listing update (pending approval) - %s";
	var $MODIFY_LISTING_EMAIL_SUBJECT_APPROVED = "Listing updated to website - %s";
	
	var $MODIFY_LISTING_EMAIL_MSG_WAITING_APPROVAL = "Thank you for your submission. Your modification will be reviewed shortly by our Administrator and updated to our directory once it is approved.\n\nYou can view the current listing at:\n\n%s\n%s";
	var $MODIFY_LISTING_EMAIL_MSG_APPROVED = "Thank you for your submission. Your listing has been updated to our directory.\n\nYou can view this listing at:\n\n%s\n%s\n\n\nThank you,\n%s";

	var $ADMIN_MODIFY_LISTING_MSG_WAITING_APPROVAL = "A Listing named \"%s\" has been updated by your website user. Please review the updated listing for approval. \n\nYou can view the current listing at:\n\n%s\n\n------------------------------\nListing Details:\n------------------------------\n\nListing Name: %s\nListing ID: %s\nOwner: %s (%s)\nE-mail: %s\nDescription:\n\n%s";
	var $ADMIN_MODIFY_LISTING_MSG_APPROVED = "A listing named \"%s\" has been updated to your website. You can view this listing at:

%s

------------------------------
Listing Details:
------------------------------\n\nListing Name: %s\nListing ID: %s\nOwner: %s (%s)\nE-mail: %s\nDescription:\n\n%s";
	// Listing approved
	var $NEW_LISTING_APPROVED_SUBJECT = "Your new Listing has been approved";
	var $NEW_LISTING_APPROVED_MSG = "Your new Listing named \"%s\" has been approved!";

	var $UPDATE_LISTING_APPROVED_SUBJECT = "Your listing modification has been approved";
	var $UPDATE_LISTING_APPROVED_MSG = "Your Listing named \"%s\" has been successfully updated!";

	// Reviews Approved
	var $REVIEW_APPROVED_SUBJECT = "Your review has been approved";
	var $REVIEW_APPROVED_MSG = "Your review to this listing:\n\n %s \n\nhas been approved";

	// Notify Admin on user initiated delete
	var $ADMIN_NOTIFY_DELETE_SUBJECT = "Listing deleted by user";
	var $ADMIN_NOTIFY_DELETE_MSG = "A Listing named \"%s\" has been removed by the owner.\n\n------------------------------\nListing Details:\n------------------------------\n\nListing Name: %s\nListing ID: %s\nUsername: %s\nE-mail: %s\nCreated: %s";

	// Claims Approved
	var $CLAIM_APPROVED_SUBJECT = "Your claim has been approved";
	var $CLAIM_APPROVED_MSG = "Your claim to this listing:\n\n %s\n%s \n\nhas been approved";
	
	// Rejected/Approved review
	var $REJECTED_APPROVED_REVIEW_SUBJECT = "Your review: %s";

	/* Back-end */
	var $ANY = 'Any';
	var $RETURN_RESULTS_IF_X_OF_THE_FOLLOWING_CONDITIONS_ARE_MET = 'Return results if %s of the following conditions are met:';
	var $UPDATE_CATEGORY = 'Update category';
	var $ALSO_APPEAR_IN_THIS_CATEGORIES = "Also appear in this category";
	var $ARROW_BACK = '< Back';
	var $MANAGE = 'Manage category';
	var $REMOVE = 'remove';
	var $IGNORE = "Ignore";
	var $RESOLVED = "Resolved";
	var $APPROVE = "Approve";
	var $REJECT = "Reject";
	var $REJECT_AND_REMOVE_VOTE = "Reject &amp; remove vote";
	var $OR_ENTER_THE_EMAIL_MESSAGE = 'or enter the e-mail message';
	var $SELECT_A_PRE_DEFINED_REPLY = '--- Select a pre-defined reply ---';
	var $SEND_EMAIL_TO_REVIEWER_UPON_APPROVAL_OR_REJECTION = 'Send e-mail to reviewer upon approval/rejection';
	var $NEXT = "Next";
	var $PREVIOUS = "Previous";
	var $SAVE = "Save";
	var $FAST_ADD = "Fast Add";
	var $OWNER = "Owner";
	var $OVERWRITE_CREATION_DATE = "Overwrite Creation Date";
	var $FEATURED = "Featured";
	var $PUBLISHED = "Published";
	var $UNPUBLISHED = "Unpublished";
	var $EXPIRED = "Expired";
	var $PENDING = "Pending";
	var $ORDERING = "Ordering";
	var $PUBLISH = "Publish";
	var $UNPUBLISH = "Unpublish";
	var $META_KEYWORDS = "META Keywords";
	var $META_DESCRIPTION = "META Description";
	var $MAIN = "Main";
	var $PUBLISHING = "Publishing";
	var $OPERATIONS = "Operations";
	var $MOVE_LINK = "Move Listing";
	var $MOVE_CATEGORY = "Move Category";
	var $MOVE_TO = 'Move To';
	var $COPY_LINK = "Copy Listing";
	var $COPY_CATEGORY = "Copy Category";
	var $COPY_TO = "Copy To";
	var $NUMBER_OF_ITEMS = "Number of Items";
	var $NAVIGATION = "Navigation";
	var $REORDER = "Reorder";
	var $MOVE_UP = "Move Up";
	var $MOVE_DOWN = "Move Down";
	var $DISPLAY = "Display #";
	var $CREATED = "Created";
	var $PARENT = "Parent";
	var $USER = "User";
	var $OPTIONS = "Options";
	var $REVIEW_TEXT = "Review Text";
	var $SEARCH_RESULTS = "Search Results";
	var $ADVANCED_SEARCH_RESULTS = "Advanced Search Results";
	var $PARAMETERS = "Parameters";
	var $LISTING_PARAMETERS = "Listing Parameters";
	var $NAVIGATE_TREE = "Navigate Tree";
	var $AWAITING_APPROVAL = "Awaiting Approval";
	var $PENDING_LISTING = "Pending Listing";
	var $PENDING_CATEGORIES = "Pending Categories";
	var $PENDING_REVIEWS = "Pending Reviews";
	var $PENDING_REVIEWS_REPORTS = "Pending Reviews' Reports";
	var $PENDING_REVIEWS_REPLIES = "Pending Owners' Replies";
	var $PENDING_REPORTS = "Pending Reports";
	var $NO_REPORT_FOUND = "No report found.";
	var $NO_REPLY_FOUND = "No reply found.";
	var $PENDING_CLAIMS = "Pending Claims";
	var $NO_CLAIM_FOUND = "No claim found.";
	var $NO_REVIEW_FOUND = "No review found.";
	var $THIS_CATEGORY = "This Category";
	var $CATEGORY_DETAILS = "Category Details";
	var $THIS_LISTING = "This Listing";
	var $MORE = "More...";
	var $RECOUNT_CATEGORIES_LISTINGS = "Recount Cats/Listings";
	var $ABOUT_MOSETS_TREE = "About Mosets Tree";
	var $FEATURED_ONLY = 'Featured listing only';
	var $NON_FEATURED_ONLY = 'Non-featured listing only';
	/*
	var $ALSO_APPEAR_IN_THESE_CATEGORIES = "Also appear in these categories";
	var $REMOVE_RELATED_CATEGORY = "Remove Related Category";
	var $REMOVE_CATEGORY = "Remove Category";
	*/
	var $ADD_RELATED_CATEGORY = "Add related category";
	var $ADD_RELATED_CATEGORIES = "Add related categories";
	var $PUBLISHING_INFO = "Publishing Info";
	var $DEFAULT = "Default";
	var $TEMPLATE = "Template";
	var $REMOVE_THIS_IMAGE = "Remove this image";
	var $IMAGE_REMOVED = "Image Removed";
	var $PREVIEW_IMAGE = "Preview Image";
	var $ADD_AN_IMAGE = 'Add an image';
	var $ADD_LISTING = "Add Listing";
	var $ADD_LISTING2 = "Add Listing to %s";
	var $ADD_CAT = "Add Category";
	var $ADD_CAT2 = "Add Category to %s";
	var $CUSTOM_FIELDS = "Custom Fields";
	var $CUSTOM_FIELD = "Custom Field";
	var $EXPLORER = "Explorer";
	var $ALLOW_SUBMISSION = "Allow listing submission";
	var $SHOW_LISTINGS = "Show Listings";
	var $EDIT_REVIEW = "Edit Review";
	var $OF = "of";
	var $HELPFULS = "Helpfuls";
	var $REVIEW_DATE = "Review Date";
	var $TOTAL_VOTES = "Total votes";
	var $TOTAL_HELPFUL_VOTES = "Total helpful votes";

	var $RECOUNT_CATS_AND_LINKS = "Recount categories and listings";
	var $FULL_RECOUNT = "Force recount of categories and listings";
	var $FULL_RECOUNT_EXPLAIN = "Full recount will force Tree to recount all sub-categories of this category. If you have a big category, this method will be very slow and might cause PHP execution timeout. However this method is the most accurate.";
	var $FAST_RECOUNT_EXPLAIN = "Fast recount will only count this active category's listings and add all sub-category listings(if available) based on the total stored in database. This is a faster method but will not be accurate if the subcategories total is not correct.";
	var $FAST_RECOUNT = "Full recount of categories and listings";
	var $CLOSE_THIS_WINDOW = "Close this window";
	var $PLEASE_WAIT_RECOUNT_IN_PROGRESS = "Please wait. Recount in progress...";
	var $DONE = "Done!";
	var $PERFORM_FULL_RECOUNT = "Perform Full Recount";
	var $PERFORM_FAST_RECOUNT = "Perform Fast Recount";

	var $NOTES = "Notes";
	var $INTERNAL_NOTES = "Internal Notes";

	var $IMPORT_EXPORT = "Import/Export";
	var $EXPORT = "Export";
	var $FIELDS = "Fields";
	var $LISTING_ID = "Listing ID";
	var $CAT_ID = "Category ID";
	var $SELECT_ALL = "Select All";
	var $UNSELECT_ALL = "Unselect All";
	var $PLEASE_SELECT_AT_LEAST_ONE_FIELD = "Please select at least one field.";

	var $ADVANCED_SEARCH = "Advanced Search";
	var $ADVANCED_SEARCH_REDIRECT = "Advanced Search Redirect";
	var $ADVANCED_SEARCH_SHORT = "more...";
	var $SEARCH_LISTINGS = "Search Listings";
	var $SEARCH_CATEGORIES = "Search Categories";
	var $HAS_IMAGE = "Has image";
	var $NO_IMAGE = "No image";
	var $EXACTLY = "Exactly";
	var $AFTER = "After";
	var $BEFORE = "Before";
	var $MORE_THAN = "More than";
	var $LESS_THAN = "Less than";
	var $ALL = "All";

	var $TEMPLATES = "Templates";
	var $TREE_TEMPLATES = "Tree Templates";
	var $SELECT_TEMPLATE_FILE_TO_EDIT = "Select a template page to edit";
	var $TOP_LISTINGS = "Top Listings (Most Rated, Most Reviewed, Most Favoured, Top Rated, New, Featured & Popular)";
	var $TEMPLATE_PAGE_EDITOR = "Template Page Editor";
	var $INDEX = "Index";
	var $MISC = "Misc";
	var $TEM_CONFIRM_DELETE = "Confirm Delete";
	var $TEM_LISTING_ERROR = "Listing Error";
	var $TEM_LISTALPHA = "Alpha";
	var $TEM_VIEW_LISTING = "View Listing";
	var $TEM_AZ = "A-Z";
	var $TEM_RECOMMEND_FORM = "Recommend Form";
	var $TEM_LISTING_DETAILS = "Listing Details";
	var $TEM_LISTING_SUMMARY = "Listing Summary";
	var $TEM_SUBCATS = "Sub Categories";
	var $TEM_USERS_FAVOURITES = "User's Favourites";
	var $TEM_USERS_REVIEWS = "User's Reviews";
	var $UPLOAD_NEW_TEMPLATE = 'Upload new template';
	var $TEMPLATE_INSTALLATION_SUCCESS = 'Template installation successful.';
	var $TEMPLATE_INSTALLATION_FAILED = 'Template installation failed.';
	
	var $WRITEABLE = "Writeable";
	var $UNWRITEABLE = "Unwriteable";

	var $COPY_RELCATS = "Copy Related Categories";
	var $COPY_SUBCATS = "Copy Sub Categories";
	var $COPY_LISTINGS = "Copy Listings";
	var $COPY_REVIEWS = "Copy Reviews";
	var $COPY_SECONDARY_CATEGORIES = "Copy Secondary Categories";

	var $RESET_HITS = "Reset Hits";
	var $RESET_RATINGS_AND_VOTES = "Reset Votes and Ratings";

	var $SELECT_AN_ITEM_TO = "Select an item to %s";

	var $SELECT_AN_ITEM_TO_APPROVE = "Select an item to approve";
	var $SELECT_AN_ITEM_TO_DELETE = "Select an item to delete";
	var $SELECT_AN_ITEM_TO_MOVE = "Select an item to move";
	var $SELECT_AN_ITEM_TO_COPY = "Select an item to copy";

	var $INVALID_OWNER_SELECT_AGAIN = "Invalid owner. Please enter a valid username";

	var $GO = 'Go';

	var $ENTER_ONE_CAT_NAME_PERLINE = "Enter one category name per line";
	
	// Spider
	var $SPIDER = "Spider";
	var $SPIDER_PROGRESS = "Spidering...";
	var $SPIDER_HAS_BEEN_UPDATED = "META data has been updated.";
	var $UNABLE_TO_GET_METATAGS = "Unable to retrieve META data.";

	// Message
	var $LINKS_HAVE_BEEN_APRROVED = "%d links have been approved";
	var $CATS_HAVE_BEEN_APRROVED = "%d categories have been approved";
	var $REVIEWS_HAVE_BEEN_APRROVED = "%d reviews have been approved";
	var $LINKS_HAVE_BEEN_DELETED = "%d links have been deleted";
	var $LISTING_MUST_HAVE_NAME = "You must enter a name for listing";
	var $CATEGORY_MUST_HAVE_NAME = "You must enter a name for category";
	var $NO_CATEGORY_ASSIGNED = "There are no categories assigned";
	var $PLEASE_ENTER_REVIEW_TEXT = "Please enter review text";
	var $THIS_IS_NOT_A_REGISTERED_USER = "This is not a registered user";
	var $OVERRIDE_CREATED_DATE= "Override Created Date";
	var $CHANGE_ALL_SUBCATS_TO_THIS_TEMPLATE = "Change all sub categories to use this template";
	var $USE_MAIN_INDEX_TEMPLATE_PAGE = "Use Main Index template page for this category";
	var $THERE_IS_ALREADY_A_PENDING_APPROVAL_FOR_MODIFICATION = "<b>* There is already a pending approval of modification for this listing. If you wish to submit modification another time, the previous modification will be removed.</b>";
	var $CONFIRM_DELETE = "Are you sure you want to delete this listing? Deleting this listing will remove all information including the reviews and rating.";
	var $CONFIRM_DELETE_CATS = "Are you sure you want to delete these categories? Deleting categories will remove all sub categories, listings and reviews inside the selected categories. This action can not be undone.";
	var $LISTING_HAVE_BEEN_DELETED = "Listing has been successfully deleted.";
	
	var $NOT_ALLOWED_TO_ADD_OWN_CAT_AS_RELCAT = "You are not allowed to add its own category as Related Category";
	var $NOT_ALLOWED_TO_ADD_OWN_CAT_AS_OTHERCAT = "You are not allowed to add this category";
	var $YOU_HAVE_ALREADY_ADD_THIS_RELCAT = "You have already added this category as Related Category";
	var $YOU_HAVE_ALREADY_ADD_THIS_CAT = "You have already added this category";
	var $CHOOSE_A_CAT_BEFORE_ADDING = "Please choose a category before adding";

	var $IMAGE_DIR_NOT_WRITABLE = "The image directory is not writable. Please chmod this directory to 777 before uploading new images: %s";
	var $IMAGE_NOT_SPECIFIED = "Please specify an image before uploading.";
	var $IMAGE_NOT_VALID = "Please specify a valid image before uploading.";
	var $DUPLICATE_IMAGE = "A file aready exists with the same name. Please rename and upload again.";
	var $ERROR_DELETING_OLD_IMAGE = "Error while deleting old image.";
	var $PLEASE_SELECT_A_JPG_PNG_OR_GIF_FILE_FOR_THE_IMAGES = 'Please select a jpg, png or gif file for the image(s).';

	var $CAT_AND_LISTING_COUNT_UPDATED = "Categories and listings count have been updated.";

	var $CANNOT_OPEN_FILE = "Operation Failed: Could not open %s";
	var $FILE_NOT_WRITEABLE = "Operation failed: %s is not writable.";
	var $TEMPLATE_PAGE_SAVED = "Template page saved successfully";
	var $COPY_PAGE_TO_CLIPBOARD = "Copy template page to clipboard";

	/* Configuration */
	var $CONFIGURATION = "Configuration";
	var $LANGUAGE = "Language";
	var $IMAGES = "Images";
	var $FEATURE = "Features";
	var $NOTIFY = "Notify";
	var $LANGUAGES = "Languages";
	var $ADMIN = "Admin";
	var $RSS = "RSS";
	var $RATINGREVIEW = "Rate & Rev.";
	var $CONFIG_HAVE_BEEN_UPDATED = "The configuration details have been updated!";
	var $REGISTERED_ONLY_EXCEPT_LISTING_OWNER = "Registered User, except Listing Owner";
	var $REGISTERED_ONLY = "Registered User";
	var $PUBLIC = "Public";
	var $NONE = "None";
	var $ASCENDING = "Ascending";
	var $DESCENDING = "Descending";
	var $CONFIGNAME_TEMPLATE = 'Template';
	var $CONFIGNAME_LANGUAGE = 'Language';
	var $CONFIGNAME_MAP = 'Map Provider';
	var $CONFIGNAME_ADMIN_EMAIL = 'Admin E-mail';
	var $CONFIGDESC_ADMIN_EMAIL = 'This is where all the notification e-mails are sent to. You can enter more than one e-mail separated by commas.';
	var $CONFIGNAME_LISTING_IMAGE_DIR = 'Listing\'s image directory';
	var $CONFIGDESC_LISTING_IMAGE_DIR = 'Enter the path to the directory where listing images are stored. Path must start and end with a slash.';
	var $CONFIGNAME_CAT_IMAGE_DIR = 'Category\'s image directory';
	var $CONFIGDESC_CAT_IMAGE_DIR = 'Enter the path to the directory where category images are stored. Path must start and end with a slash.';
	var $CONFIGNAME_RESIZE_METHOD = 'Resize Method';
	var $CONFIGNAME_RESIZE_QUALITY = 'Image Quality';
	var $CONFIGDESC_RESIZE_QUALITY = 'Enter a value between 0 - 100. 100 being best quality.';
	var $CONFIGNAME_RESIZE_LISTING_SIZE = 'Small/Thumbnail\'s image size';
	var $CONFIGDESC_RESIZE_LISTING_SIZE = 'This is the maximum width and height of a thumbnail image.';
	var $CONFIGNAME_SQUARED_THUMBNAIL = 'Squared thumbnail';
	var $CONFIGDESC_SQUARED_THUMBNAIL = 'Setting this to Yes will generate thumbnails with a square dimension. This will produce a consistent set of thumbnails with same dimension in the directory. However for some images, the sides of the thumbnail could be cropped out in order to fit in to a square.';
	var $CONFIGNAME_RESIZE_MEDIUM_LISTING_SIZE = 'Medium\'s image size';
	var $CONFIGDESC_RESIZE_MEDIUM_LISTING_SIZE = 'This is the maximum width and height of a medium sized image.';
	var $CONFIGNAME_IMG_IMPATH = 'Imagemagick path';
	var $CONFIGNAME_IMG_NETPBMPATH = 'NetPBM path';
	var $CONFIGNAME_RESIZE_CAT_SIZE = 'Category\'s image size';
	var $CONFIGDESC_RESIZE_CAT_SIZE = 'This is the maximum width and height of a category image.';
	var $CONFIGNAME_FIRST_CAT_ORDER1 = 'Primary ordering';
	var $CONFIGNAME_SECOND_CAT_ORDER1 = 'Secondary ordering';
	var $CONFIGNAME_FIRST_LISTING_ORDER1 = 'Primary ordering';
	var $CONFIGNAME_SECOND_LISTING_ORDER1 = 'Secondary ordering';
	// var $CONFIGNAME_FULLTEXT_SEARCH = 'Full-Text search';
	// var $CONFIGDESC_FULLTEXT_SEARCH = 'This option enable you to use MySQL Full-Text searching feature to return a more accurate search results through the simple search module. If you\'re using full-text searching, please make sure *only* the \'Name\' and \'Description\' field is set to Yes below.';
	var $CONFIGNAME_FIRST_REVIEW_ORDER1 = 'Primary ordering';
	var $CONFIGNAME_SECOND_REVIEW_ORDER1 = 'Secondary ordering';
	var $CONFIGNAME_THIRD_REVIEW_ORDER1 = 'Tertiary ordering';
	var $CONFIGNAME_FIRST_SEARCH_ORDER1 = 'Primary ordering';
	var $CONFIGNAME_SECOND_SEARCH_ORDER1 = 'Secondary ordering';
	var $CONFIGNAME_DISPLAY_EMPTY_CAT = 'Display empty category';
	var $CONFIGNAME_ALLOW_USER_ASSIGN_MORE_THAN_ONE_CATEGORY = 'Allow user to assign more than one category to listing';
	var $CONFIGDESC_DISPLAY_ALPHA_INDEX = 'Alpha index shows the complete list of alphabets to allow visitors to browse the directory by letters. This also includes number (0-9)';
	var $CONFIGNAME_ALPHA_INDEX_ADDITIONAL_CHARS = 'Additional characters for Alpha Index';
	var $CONFIGDESC_ALPHA_INDEX_ADDITIONAL_CHARS = 'You can enter additional characters to the end of the alpha list. Enter the characters one after another. ie: �&#8230;�&#8222;�&#8211;';
	var $CONFIGNAME_ALLOW_LISTINGS_SUBMISSION_IN_ROOT = 'Allow listings submission in root';
	var $CONFIGNAME_ALLOW_CHANGING_CATS_IN_ADDLISTING = 'Allow changing of category in Add Listing';
	var $CONFIGNAME_DISPLAY_LISTINGS_IN_ROOT = 'Display listings in root';
	var $CONFIGNAME_TRIGGER_MODIFIED_LISTING = 'Required fields to mark listing as updated';
	var $CONFIGDESC_TRIGGER_MODIFIED_LISTING = 'By default, any update to a listing causes the listing to be updated with a new modified date. This option allows you to enter one or more fields (seperated by comma) that must be changed before a listing is marked as updated.';
	var $CONFIGNAME_SHOW_FAVOURITE = 'Show Favourite';
	var $CONFIGNAME_SHOW_MAP = 'Show map';
	var $CONFIGNAME_SHOW_PRINT = 'Show print';
	var $CONFIGNAME_SHOW_RECOMMEND = 'Show recommend';
	var $CONFIGNAME_SHOW_RATING = 'Show rating';
	var $CONFIGNOTE_OPTIONAL_EMAIL_SENT_TO_REVIEWER = 'An optional e-mail can be sent to reviewer after an approval or rejection of a review. Please enter the name and e-mail address to appear in the e-mail. You can also optionally send a blank carbon copy to an e-mail address.';
	var $CONFIGNAME_PREDEFINED_REPLY_FROM_NAME = 'From Name';
	var $CONFIGNAME_PREDEFINED_REPLY_FROM_EMAIL = 'From E-mail';
	var $CONFIGNAME_PREDEFINED_REPLY_BCC = 'BCC E-mail';	
	var $CONFIGNOTE_PREDEFINED_REPLY_FOR_APPROVED_OR_REJECTED_REVIEW = 'You can enter up to 5 pre-defined e-mail replies below (title of the reply/reply message).';
	var $CONFIGNAME_PREDEFINED_REPLY_1_TITLE = 'Pre-defined reply #1';
	var $CONFIGNAME_PREDEFINED_REPLY_2_TITLE = 'Pre-defined reply #2';
	var $CONFIGNAME_PREDEFINED_REPLY_3_TITLE = 'Pre-defined reply #3';
	var $CONFIGNAME_PREDEFINED_REPLY_4_TITLE = 'Pre-defined reply #4';
	var $CONFIGNAME_PREDEFINED_REPLY_5_TITLE = 'Pre-defined reply #5';
	var $CONFIGNOTE_NOTE_RATING = '<b>Rating</b>';
	var $CONFIGNAME_SHOW_REVIEW = 'Show review';
	var $CONFIGNAME_ALLOW_RATING_DURING_REVIEW = 'Allow rating during review';
	var $CONFIGNAME_REQUIRE_RATING_WITH_REVIEW = 'Require rating during review';

	var $CONFIGNOTE_NOTE_REVIEW = '<b>Review</b>';
	var $CONFIGNAME_SHOW_VISIT = 'Show visit';
	var $CONFIGNAME_SHOW_CONTACT = 'Show contact';
	var $CONFIGNAME_USE_OWNER_EMAIL = 'Use user\'s e-mail address if listing e-mail is empty';
	var $CONFIGNAME_SHOW_REPORT = 'Show report';
	var $CONFIGNAME_SHOW_CLAIM = 'Show claim';
	var $CONFIGNAME_SHOW_OWNERLISTING = 'Show owner\'s listing';
	var $CONFIGNAME_FE_NUM_OF_CHARS = 'Number of summary characters';
	var $CONFIGNAME_FE_NUM_OF_LINKS = 'Number of listings per page';
	var $CONFIGNAME_FE_NUM_OF_REVIEWS = 'Number of reviews per page';
	var $CONFIGNAME_FE_NUM_OF_POPULARLISTING = 'Number of popular listings per page';
	var $CONFIGNAME_FE_NUM_OF_NEWLISTING = 'Number of new listings per page';
	var $CONFIGNAME_FE_TOTAL_NEWLISTING = 'Total new listings';
	var $CONFIGNAME_FE_NUM_OF_RECENTLYUPDATED = 'Number of recently updated listings per page';
	var $CONFIGNAME_FE_NUM_OF_MOSTFAVOURED = 'Number of most favoured listings per page';
	var $CONFIGNAME_FE_NUM_OF_MOSTRATED = 'Number of most rated listings per page';
	var $CONFIGNAME_FE_NUM_OF_TOPRATED = 'Number of top rated listings per page';
	var $CONFIGNAME_FE_NUM_OF_MOSTREVIEW = 'Number of most reviewed listings per page';
	var $CONFIGNAME_FE_NUM_OF_SEARCHRESULTS = 'Number of search results per page';
	var $CONFIGNAME_FE_NUM_OF_FEATURED = 'Number of featured listings per page';
	var $CONFIGNAME_RATE_ONCE = 'User can only rate once';
	var $CONFIGNAME_MIN_VOTES_FOR_TOPRATED = 'Minimum number of votes to be considered for top rated listings';
	var $CONFIGNAME_MIN_VOTES_TO_SHOW_RATING = 'Minimum number of votes to show rating';
	var $CONFIGNAME_ALLOW_OWNER_RATE_OWN_LISTING = 'Allow owner to rate own listing';
	var $CONFIGNAME_USER_REVIEW_ONCE = 'User can only review once';
	var $CONFIGNAME_USER_VOTE_REVIEW = 'Allow registered user to vote on helpful reviews';
	var $CONFIGNAME_ALLOW_OWNER_REVIEW_OWN_LISTING = 'Allow owner to review own listing';
	var $CONFIGNAME_OWNER_REPLY_REVIEW = 'Allow owner to reply to reviews';
	var $CONFIGNAME_USER_REPORT_REVIEW = 'Who can report review';
	var $CONFIGNAME_USER_CONTACT = 'Who can contact listing owner';
	var $CONFIGNAME_USER_RATING = 'Who can make a rating';
	var $CONFIGNAME_USER_REVIEW = 'Who can submit a review';
	var $CONFIGNAME_USER_REPORT = 'Who can report a listing';
	var $CONFIGNAME_USER_RECOMMEND = 'Who can recommend a listing';
	var $CONFIGNAME_USER_ADDLISTING = 'Who can suggest listing';
	var $CONFIGNAME_USER_ADDCATEGORY = 'Who can suggest category';
	var $CONFIGNAME_USER_ALLOWMODIFY = 'Allow owner to modify listing';
	var $CONFIGNAME_USER_ALLOWDELETE = 'Allow owner to delete listing';
	var $CONFIGNAME_NEEDAPPROVAL_ADDLISTING = 'Adding new listing requires approval';
	var $CONFIGNAME_NEEDAPPROVAL_MODIFYLISTING = 'Modify listing requires approval';
	var $CONFIGNAME_NEEDAPPROVAL_ADDCATEGORY = 'Adding new category requires approval';
	var $CONFIGNAME_NEEDAPPROVAL_ADDREVIEW = 'Adding new review requires approval';
	var $CONFIGNAME_NEEDAPPROVAL_REPLYREVIEW = 'Replying to review requires approval';
	var $CONFIGNAME_LINK_NEW = 'Number of days to show as new listing';
	var $CONFIGNAME_LINK_POPULAR = 'Number of average per day hits to show as popular listing';
	var $CONFIGNAME_HIT_LAG = 'Number of seconds before next vote is allowed';
	var $CONFIGNOTE_NOTE_NOTIFY_ADMIN = 'Configure if notification e-mails are sent to <b>Admin</b> when the following event occurs.';
	var $CONFIGNOTE_NOTE_NOTIFY_OWNER = 'Configure if notification e-mails are sent to <b>Owner</b> when the following event occurs.';
	var $CONFIGNAME_NOTIFYUSER_NEWLISTING = 'New listing';
	var $CONFIGNAME_NOTIFYADMIN_NEWLISTING = 'New listing';
	var $CONFIGNAME_NOTIFYUSER_MODIFYLISTING = 'Modify listing';
	var $CONFIGNAME_NOTIFYADMIN_MODIFYLISTING = 'Modify listing';
	var $CONFIGNAME_NOTIFYADMIN_NEWREVIEW = 'New review';
	var $CONFIGNAME_NOTIFYUSER_APPROVED = 'Listing approved';
	var $CONFIGNAME_NOTIFYUSER_REVIEW_APPROVED = 'Review approved';
	var $CONFIGNAME_NOTIFYADMIN_DELETE = 'Delete listing';
	var $CONFIGNAME_USE_INTERNAL_NOTES = 'Use Internal Notes';
	var $CONFIGNAME_USE_WYSIWYG_EDITOR = 'Use WYSIWYG Editor in front-end Description field';
	var $CONFIGNAME_SHOW_LISTNEWRSS = 'Show Latest Listings RSS';
	var $CONFIGNAME_SHOW_LISTUPDATEDRSS = 'Show Recently Updated Listings RSS';
	var $CONFIGNAME_ALLOW_IMGUPLOAD = 'Allow owner to upload image';
	var $CONFIGNAME_IMAGES_PER_LISTING = 'Images per listing';
	var $CONFIGNOTE_NOTE_RSS_CUSTOM_FIELDS = 'Options below allows you to select Mosets Tree fields to create additional elements for the RSS Feed. The additional element will look like this: &lt;mtree:<b>cust_1</b>&gt;<b>value</b>&lt;/mtree&gt;, where <b>cust_1</b> will be replaced by the custom field name and <b>value</b> is the value of the field for a listing.';
	var $CONFIGNAME_RSS_CAT_NAME = 'Category Name';
	var $CONFIGNAME_RSS_CAT_URL = 'Category URL';
	var $CONFIGNAME_RSS_LINK_VOTES = 'Votes';
	var $CONFIGNAME_RSS_LINK_RATING = 'Rating';
	var $CONFIGNAME_RSS_ADDRESS = 'Address';
	var $CONFIGNAME_RSS_CITY = 'City';
	var $CONFIGNAME_RSS_POSTCODE = 'Postcode';
	var $CONFIGNAME_RSS_STATE = 'State';
	var $CONFIGNAME_RSS_COUNTRY = 'Country';
	var $CONFIGNAME_RSS_EMAIL = 'E-mail';
	var $CONFIGNAME_RSS_WEBSITE = 'Website';
	var $CONFIGNAME_RSS_TELEPHONE = 'Telephone';
	var $CONFIGNAME_RSS_FAX = 'Fax';
	var $CONFIGNAME_RSS_METAKEY = 'META Key';
	var $CONFIGNAME_RSS_METADESC = 'META Description';
	var $CONFIGNAME_RSS_CUSTOM_FIELDS = 'Custom Fields';
	var $CONFIGDESC_RSS_CUSTOM_FIELDS = 'Enter the IDs of the custom fields seperated by comma. e.g: <i>17,2,29,31</i>';
	
	var $CONFIGNAME_ADMIN_USE_EXPLORER = 'Use Explorer';
	var $CONFIGNAME_EXPLORER_TREE_LEVEL = 'Explorer\'s Tree Level';
	var $CONFIGNAME_USE_WYSIWYG_EDITOR_IN_ADMIN = 'Use WYSIWYG Editor description field in back-end';
	
	/* Spy Directory */
	var $SPY_DIRECTORY = "Spy Directory";
	var $IP_ADDRESS = 'IP Address';
	var $CLONES = 'Clones';
	var $LISTINGS_OWNED_BY_SUSPECT_CLONERS = 'Listings owned by suspect cloners';
	var $NO_CLONE_DETECTED = 'No clone detected.';
	var $RATINGS_AND_VOTES = 'Ratings and Votes';
	var $VIEW_LISTING = 'View Listing';
	var $ACTIVITIES = 'Activities';
	var $OWNER_VOTE = 'Owner Vote';
	var $CLONE_VOTE = 'Clone Vote';
	var $OWNER_REVIEW = 'Owner Review';
	var $CLONE_REVIEW = 'Clone Review';
	var $ANALYSIS_FOR_ACTUAL_RATING = '<b>%s%%</b> of the votes above (<b>%s out of %s</b>) are casted by suspected clones.<br />Assuming that these votes gives full rating, the actual rating for this listing is <b>%s</b>';
	var $OUT_OF = '%s out of %s';
	var $LISTING_NAME = 'Listing Name';
	var $VIEW_USER = 'View User';
	var $PASSWORD_HASH = 'Password Hash';
	var $USERNAME = 'Username';
	var $VIEW_SAME = 'View same';
	var $REGISTER = 'Register';
	var $LAST_VISIT = 'Last Visit';
	var $USER_ID = 'User ID';
	var $LISTING_REVIEW = 'Listing (Review)';
	var $WRITTEN_REVIEWS = 'Written Reviews';
	var $OWNED_LISTINGS = 'Owned Listings';
	var $USERS = 'Users';
	var $UNREGISTERED = 'unregistered';
	var $LAST_ACTIVITY = 'Last Activity';
	var $VIEW_USERS = 'View Users';
	var $VIEW_LISTINGS = 'View Listings';
	var $VIEW_CLONES = 'View Clones';
	var $SEARCH_USERS = 'Search Users';
	var $BACK_TO_DIRECTORY = 'Back to Directory';
	var $LATEST_LISTINGS = 'Latest Listings';
	var $MOST_VOTES = 'Most Votes';
	var $HIGHEST_RATING = 'Highest Rating';
	var $MOST_REVIEWS = 'Most Reviews';
	var $MOST_HITS = 'Most Hits';
	var $RECENTLY_UPDATED = 'Recently Updated';
	var $FEATURED_FIRST = 'Featured First';
	var $VIEW_USERS_PAGE_IN_FRONT_END = 'View user\'s page in front-end (new window)';
	var $EDIT_USER_IN_USER_MANAGER = 'Edit user in User Manager';
	var $REMOVE_USER_INCLUDING_HIS_HER_ACTIVITIES = 'Remove user including his/her listings, reviews and activities';
	var $MARK_THIS_USER_AS_CLONE = 'Mark this user as clone...';
	var $REMOVE_S_INCLUDING_HIS_HER_ACTIVITIES = 'Remove %s, including his/her activities';
	var $REMOVED_CLONES = 'Removed Clones';
	var $ACTIVITIES_SUCCESSFULLY_REMOVED = 'Activities successfully removed.';
	var $CONFIRM_REMOVE_USER_AND_ALL_ITS_DATA = 'Are you sure you want to remove this user and all its data in the directory?\n\nThis action can not be undone. If you click OK, this user and all his/her listings, reviews and activities log will be permanently removed.';
	var $USER_SUCCESSFULLY_REMOVED = 'User successfully removed.';
	var $THIS_USER_HAS_NOT_CAST_ANY_VOTES_YET = 'This user has not cast any listing votes or reviews votes yet.';
	var $CLONE = 'Clone';
	var $LATEST_ACTIVITIES = 'Latest Activities';
	var $LATEST_USERS = 'Latest Users';
	var $MOST_HELPFULS = 'Most Helpfuls';
	var $MOST_LISTINGS = 'Most Listings';
	var $RECENTLY_LOGIN = 'Recently Login';
	
	/* Link Checker */
	var $LINK_CHECKER = 'Link Checker';
	var $LINKS_REMAINING = ' links remaining';
	var $LINK_CHECKER_COMPLETED = 'Link Checker Completed.';
	var $THERE_ARE_X_LINKS_IN_THE_DIRECTORY = 'There are %s links in the directory.';
	var $LAST_CHECKED_DATE = ' Last Checked: %s';
	var $ADVANCED_OPTIONS = 'Advanced Options';
	var $SHOW_ALL_LINKS = 'Show all links';
	var $CHECK_X_LINKS_EVERY_Y_SECONDS = 'Check %s links every %s seconds';
	var $STATUS_CODE_AND_REASON = 'Status Code &amp; Reason';
	var $ACTION = 'Action';
	
	/* Custom Fields */
	var $ID = 'ID';
	var $CAPTION = 'Caption';
	var $FIELD_TYPE = 'Field Type';
	var $FIELD_ELEMENTS = 'Field Elements';
	var $FIELD_ELEMENTS_NOTE = 'Enter elements seperated by |';
	var $PREFIX = 'Prefix';
	var $SUFFIX = 'Suffix';
	var $SIZE = 'Size';
	var $COLUMNS = 'Columns';
	var $REQUIRED_FIELD = 'Required Field';
	var $HIDDEN_FIELD = 'Hidden Field';
	var $SOME_FIELDTYPE_HAS_PARAMS_DESC = 'Some custom field types has optional parameters which allows you to customize the appearance or behaviour of the field. Click the \'Apply\' icon above when you have completed filling in the form to check the parameters.';
	var $HIDDEN_FIELD_DESC = 'When a field is hidden, it will be not editable in the front-end. To completely hide a field in the front-end, you need to remove it from details, summary view and select \'No\' for Simple Searchable and Advanced Searchable.';
	var $HIDE_CAPTION = 'Hide caption';
	var $ADVANCED_SEARCHABLE = 'Advanced Searchable';
	var $SIMPLE_SEARCHABLE = 'Simple Searchable';
	var $SHOWN_IN_DETAILS_VIEW = 'Shown in details view';
	var $SHOWN_IN_SUMMARY_VIEW = 'Shown in summary view';
	var $CUSTOM_FIELD_DETAILS = 'Custom Field\'s Details';
	var $WARNING_COMMAS_ARE_NOT_ALLOWED_IN_FIELD_ELEMENTS = 'Commas are not allowed in field elements. Please remove the comma and try again.';
	var $REQUIRED = 'Required';
	var $PLEASE_SELECT_AN_ITEM_TO_PUBLISH_OR_UNPUBLISH = 'Please select an item to publish or unpublish.';
	var $CANNOT_DELETE_CORE_FIELD = 'Can not delete core field';
	var $CANNOT_DELETE_CORE_FIELDTYPE = 'Can not delete core fieldtype';
	var $BASIC_FIELDTYPES = 'Basic Fieldtypes';
	var $CUSTOM_FIELDTYPES = 'Custom Fieldtypes';
	var $CORE_FIELD = 'Core Field';
	var $CORE_FIELDTYPE = 'Core Fieldtype';
	var $CORE = 'Core';
	var $FIELD_TYPE_TEXT = 'Text';
	var $FIELD_TYPE_MULTITEXT = 'Multi Text';
	var $FIELD_TYPE_SELECTLIST = 'Select List';
	var $FIELD_TYPE_RADIOBUTTON = 'Radio Button';
	var $FIELD_TYPE_CHECKBOX = 'Checkbox';
	var $FIELD_TYPE_SELECTMULTIPLE = 'Select Multiple';
	var $FIELD_TYPE_WEBLINK = 'Web Link';
	var $FIELD_TYPE_FILE = 'File';
	var $PLEASE_FILL_IN_THE_FIELDS_CAPTION = 'Please fill in the Field\'s caption.';
	var $MANAGE_FIELD_TYPES = 'Manage field types';
	var $BACK_TO_CUSTOM_FIELDS = 'Back to custom fields';
	var $FIELD_TYPE_DETAILS = 'Field Type\'s details';
	var $PLEASE_COMPLETE_THE_FIELD_TYPE_NAME_CAPTION_AND_CODE_BEFORE_SAVING = 'Please complete the field type name, caption and PHP class code before saving.';
	var $DOWNLOAD = 'Download';
	var $FAILED_TO_INSTALL_FIELD_TYPE_1 = 'Failed to install field type. There is a field type already installed with the same name.';
	var $FIELD_TYPE_INSTALLATION_SUCCESS = 'Field type installation successful.';
	var $FIELD_TYPE_UPGRADED_SUCCESSFULLY = 'Field type upgraded successfully.';
	var $PREFIX_AND_SUFFIX_TEXT_TO_DISPLAY_DURING_FIELD_MODIFICATION = 'Prefix and Suffix text to display during field modification';
	var $PREFIX_AND_SUFFIX_TEXT_TO_DISPLAY_DURING_DISPLAY = 'Prefix and Suffix text during display';
	var $INSTALL_NEW_FIELD_TYPE = 'Install/Update new field type';
	var $UPLOAD_PACKAGE_FILE = 'Upload Package File';
	var $PACKAGE_FILE = 'Package file';
	var $UPLOAD_FILE_AND_INSTALL = 'Upload File &amp; Install/Update';
	var $OR_CREATE_A_NEW_FIELD_TYPE = 'Or create a new custom field type';
	var $EDIT_FIELD_TYPE = 'Edit field type';
	var $NAME_OF_THE_FIELD_TYPE = 'Name of the field type';
	var $PHP_CLASS_CODE = 'PHP Class Code';
	var $USES_ELEMENTS = 'Uses elements?';
	var $USES_SIZE = 'Uses size?';
	var $USES_COLUMNS = 'Uses columns?';
	var $INSTALLED_FIELD_TYPES = 'Installed field types';
	var $DOWNLOAD_XML = 'Download XML';
	var $ATTACHMENTS = 'Attachments';
	var $PLEASE_ENTER_A_VALID_URL = 'Please enter a valid URL.';
	var $PLEASE_ENTER_A_VALID_EMAIL = 'Please enter a valid e-mail address.';
	var $PLEASE_ENTER_A_VALID_NUMBER = 'Please enter a valid number without commas and not more than 2 decimals.';
	var $CONTAINS_FILE = 'Contains file';
	var $DETAILS_VIEW = 'Details view';
	var $SUMMARY_VIEW = 'Summary view';
	
	/* Toolbars */
	var $EDIT_CATEGORY = "Edit Category";
	var $DELETE_CATEGORIES = "Delete Categories";
	var $COPY_CATEGORIES = "Copy Categories";
	var $MOVE_CATEGORIES = "Move Categories";
	var $DELETE_LISTINGS = "Delete Listings";
	var $MOVE_LISTINGS = "Move Listings";
	var $DELETE_LISTINGS_MSG = "Please make a selection from the list to delete listing(s)";
	var $MOVE_LISTINGS_MSG = "Please make a selection from the list to move listing(s)";
	var $COPY_LISTINGS_MSG = "Please make a selection from the list to copy listing(s)";
	var $SAVE_CHANGES = "Save Changes";
	var $APPROVE_AND_PUBLISH_LISTING = "Approve &amp; Publish Listing";
	var $APPROVE_AND_PUBLISH_LISTING_MSG = "Please make a selection from the list to approve &amp; publish listing";
	var $APPROVE_AND_PUBLISH = "Approve &amp; Publish";
	var $APPROVE_CATEGORIES = "Approve Categories";
	var $BACK = "Back";
	var $NEW = "New";
	var $UNINSTALL = "Uninstall";
	
	/* About Mosets Tree */
	var $VERSION = "Version";
	var $AUTHOR = "Author";
	var $LICENSE = "License";
	var $DATE = "Date";
	var $LICENSE_AGREEMENT = "License Agreement";
	var $COPYRIGHT_TEXT = "<center>Mosets Consulting &copy; 2005-2007 All rights reserved. Mosets Tree is a Proprietary software.<br />Please read the <a href=\"index2.php?option=com_mtree&task=license\">license agreement</a> before using this product</center>";
}
global $_MT_LANG;
$_MT_LANG = new mtLanguage();

?>
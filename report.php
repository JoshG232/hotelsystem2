<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Website</title>
    <script src="./app.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.html';?>
    <?php include 'headerNav.php';?>
    <div class="report">
    <h1 class="htext" >Evaluation of website</h1>
    <p class="text">An evaluation of the website will be made using theory learned from the course and wider readings. This evaluation will point out why the website was made in a certain way. This will also provide the problems the website might have had and the problems the user would have faced due to the issues discussed. I will also compare other websites that competing websites and discuss the impact of the differences between them.</p>
   
    <h2 class="htext">Styling, look and feel of the website using Nielsen 10 usability Heuristics</h2>
    <h3 class="htext">#1 Visibility of system status</h3>
    <p class="text">The user needs to be kept informed of the website’s status when using it. This creates predictable interactions which create trust in the product as well as the brand (Nielsen, 2020).
    When the user first enters the webpage, they are sent to the home page every time and they will see in the nav bar the status of the webpage. The first part they will see is to log in/register to the website. Once the user logs in or registers the user will be able to see “Welcome [First name of user]” now in the nav bar. This shows the status of them being logged into the system. This means that the next time they use the website they can clearly see if they need to log in or not. This is very clear to the user providing a good interaction.
    </p>
    <img src="./reportImages/rightNav.png" alt="">

    <h3 class="htext">#2 Match between system and the real world</h3>
    <p class="text">Use real-world conventions and language and do not use internal jargon.
    When using the website, the user doesn’t want to be overwhelmed with jargon and words that they don’t understand. This will confuse them and make the experience much worse for them. The website is set up so no jargon is used and every step across the process should be easy and simple to understand to anyone. When I look at the website, I completely understand how it should work as I have created the website and have a good understanding of technology. To other users, it won’t be that way so with some testing of the website from other people I made certain processes easier that I thought were easier. 
    One feature that was changed was the presentation of data in each “card” of information.  When I wrote out the fields of what the data was, I was using the name of the records in the database tables. I was using the jargon of the data which made it confusing to some users about what data they were seeing. I changed the field names that were being presented so the user could more easily see what data they were viewing.
    </p>
    <img src="./reportImages/fieldNames.png" alt="">

    <h3 class="htext">#3 User control and freedom</h3>
    <p class="text">When mistakes are made by the user they should be easily reversed or actionable to remove the mistake. An exit for each action/process should also be available to the user. This means the user won’t feel stuck in the system and just want to leave.
    For the website, there are a few features to help the user feel more in control and free. The first feature will be the navigation bar that is on every webpage that the user can access. This means that the user can freely move around to any page that they can access at any time. So, if the user wants to go back to the home page, then they can. The next feature will be on the booking, basket, wish list and account pages. Any time the user makes an order of any kind they will be able to delete/update the information. So, if the user makes a mistake, they can easily remove the order or just update the information that they incorrectly inputted. Once the user logs in the logout button are on every page and easily viewable in the navigation bar. 
    </p>
    <img src="reportImages/navBar.png" alt="">
    
    <h3 class="htext">#4 Consistency and standards</h3>
    <p class="text">For consistency, the website should provide consistency of words and styling so the user can understand what they need to do for each situation. For standards, the website should stray away from a completely new way of doing processes. This could be login/registration, booking, viewing content, etc. New processes create learning for the user which might put them off continuing with the website.
    When the user is using the website, the styling is consistent throughout the whole website and the process of booking. This creates familiarity with the website and creates a sense of something that they know well. Doing research into other websites was key in part for the keeping standards of the website. I kept my design like competing for websites as my users will have most likely used their websites so it will be easy for them to use the website. One website I looked at was premierinn.com. The navigation bar was clear throughout with their logo and title being at the top as well. They had information about their hotels and images on their home page. They have a search “bar” that consists of inputting some information to get rooms. I did this differently on the website as I thought it was quite in the face of the user and the user might just want to look at the available images and information at the start. But it is easy enough for the user to start the booking process by selecting “Booking/content” in the navigation bar. As this heading is in the navigation bar it makes it easier to start the booking process at any time when the user is on the website. This puts the website ahead of some of the competition.
    </p>
    <img src="./reportImages/premierinnNav.png" alt="">
    <br>
    <img src="./reportImages/premierinnAboutUs.png" alt="">
    <br>
    <img src="./reportImages/leftNav.png" alt="">

    <h3 class="htext">#5 Error prevention</h3>
    <p class="text">The user will easily be discouraged by errors, so we want to prevent all of them from showing and happing. The worst kind of error will be what the user can see. After that, an error will be what the user doesn’t expect to happen when they are using and viewing the website. Prioritization is key here as well removing the large high-cost errors first and then working on the small frustrations that the user may have.
    Thorough testing has been carried out to remove all the high-cost errors from the website. This is mainly the PHP errors that could show up on the page if something happens. Then moving down to the smaller errors of something just not happening when the user excepts it to. Validation takes a key role in preventing errors. Front-end validation is used in HTML, CSS and JavaScript and is any validation before a server request is made. It is important that the client does some validation as it stops high-cost errors like PHP errors from showing. Back-end validation is when the request has been sent for the data to be collected. This means using filters to sanitize the inputs the user has made. This will stop SQL injections and the user input they shouldn’t have in the database. If an error is picked up the user will be notified. Another way that errors are prevented is by removing options that the user shouldn’t have available to them. One way this is done is with the navigation bar. If the user is not logged in, they won’t have access to any type of booking and will be prompted to log in. They can still view the content but not start the booking process.
    </p>
    <img src="reportImages/code.png" alt="">

    <h3 class="htext">#6 Recognition rather than recall</h3>
    <p class="text">Recognising processes and elements and understanding what they do is important to the user as it means they don’t have to remember what does what and remember how everything works throughout the process. It should be easy for them to understand what something does every time they see it.
    Styling is important to elements being all the same throughout the process. The styling is consistent throughout the process both in the desktop and mobile views of the website. This means that the user can use either and still recognize what should happen. All the field names used in the information cards are the same all the way through the process to help understand what is being shown. All buttons clearly state the action that they will perform as well. So, there is no testing from the user to find out what they do and how it all works. Clear recognition is better than the user trying the remember what they think the button does from recall.
    </p>
    <img src="reportImages/button1.png" alt="">
    <img src="reportImages/button2.png" alt="">

    <h3 class="htext">#7 Flexibility and efficiency of use</h3>
    <p class="text">There will be different types of users using the website it will be split into experienced and inexperienced users. The website needs to be able to cater to both the users just as well as each other. Keyboard shortcuts, personalization and customization are some key methods to help provide efficiency and flexibility to all users.
    This section was one of the harder sections to complete as it was hard to provide some of the key methods of flexibility and efficiency, even other websites weren’t providing much for both types of users. The navigation bar is a good example of how the website provides efficiency of use. To inexperienced users, they can go through each section and learn what each page is about and what it does.  Experienced users will be able to go straight to whatever page they need as they can read the headings and figure out what page they need to go to. This goes back to point #6 of recognition rather than recall for each page presented to the user by the navigation bar.
    </p>
    <img src="reportImages/navBar.png" alt="">

    <h3 class="htext">#8 Aesthetic and minimalist design</h3>
    <p class="text">Interfaces should not contain information that is not needed by the user. The more information that is on an interface the more competition there is for what is going to be relevant and viewable to the user.
    I’ve kept the whole design of the website to only show the essentials that need to be shown. The information provided is all relevant to the user and nothing is needed at this time with the requirements set. The visual design is minimalist as well as there is no extra clutter on the website to distract the user from the essential information. I’ve also tried to prioritize the content and features is away so that when the user looks from left to right and top to bottom, they see the most relevant information first. Most users will glance over the website with a F-shaped pattern. This means that the top left and top is a good way to grab the user’s attention. Therefore the “Home”, and “Content/booking” are in the top left and the “Login/Register” is in the top right. The “F” doesn’t just stand for the shape but also fast. A user will quickly glance across the whole website in the F shape, so we need to engage the user quickly without much text to do this. Images will help with this so the slideshow on the home page is helpful to get the user’s attention and keep them on the website.
    </p>
    <img src="reportImages/navBar.png" alt="">

    <h3 class="htext">#9 Help users recognize, diagnose and recover from errors</h3>
    <p class="text">Error messages can be used to help the user through the process if they enter incorrect information and no actual error codes from the code itself. Presenting the message with the problem and way to resolve the issue. It should be clear though the user has made a mistake in the process.
    For the website, there are ways that the user can not follow the process correctly, but that is ok because it is not always clear what the user should do. But it is the website’s job to correct this and present what has happened, why and how to solve it. One way in which the user is helped through the process is by registering on the website. If the user is filling out the registration form and forgets to fill in an input box, the website will alert them when they try to submit the form. It will do this by telling them the input box they have missed and tell that it is required to move forward with submitting the form. It will also be seen in red as this is a classic way for a website to show an error has happened. This links back to #4 consistency and standards where most websites and applications will use red to indicate a mistake that has been made. It is important the user understands what has happened but also how to fix the issue. The combination of the wording and the use of the red colouring shows this.
    </p>
    <img src="reportImages/firstname register form.png" alt="">

    <h3 class="htext">#10 Help and documentation </h3>
    <p class="text">Systems shouldn’t need extra help to use but it might be useful to the user for extra documentation on how to use the system and complete the tasks. 
    This is where the website is lacking, and documentation is available to the user for how to use the website. However, I believe that the processes are quite simple and can be easily followed by most internet users that will be on the website. The steps created make it easy to follow the process and for what the user should do next.
    </p>
    
    <h2 class="htext">Summary</h2>
    <p class="text">Through the evaluation, I have spoken about course theory and the use of heuristics such as the 10 usability heuristics for user interface design. Also commented on the problems that my website had and has with any of the issues that a user may have come across if the issues were still there. Also comparing my website design to other competing websites for hotel room booking.</p>
    </div>
    <?php include 'footer.html' ?>

</body>
</html>
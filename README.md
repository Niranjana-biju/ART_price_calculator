Project Title: ART Pricing System

The Problem:
Many artists struggle to determine a fair price for their artwork. Pricing is often inconsistent and subjective, depending on factors like time spent, material cost, skill level, and complexity.
This project solves that problem by providing a structured and logical pricing system that helps artists calculate a suggested price based on these factors.

Tech Stack- 
Frontend: HTML, CSS
Backend: PHP
Database: MySQL
Server Environment: XAMPP (Apache)

Key Features: 
--> Upload artwork images
--> Automatic price calculation based on logic
--> Pricing based on:- Time spent, Material cost, Complexity, Experience level
    Calculated using-
    Base Price = (Hours × Hourly Rate) + Material Cost  
    Suggested Price = Base Price × Complexity Multiplier
    -> Hourly rate is assigned based on experience level
    -> Multiplier is applied based on complexity
--> Gallery view of all artworks
--> Search artworks by name
--> Delete artworks with confirmation
-->Click artwork to view full details
--> Aesthetic UI with custom theme (black + stars)

How to Run: 
1. Install and open XAMPP
   
2. Start:
   Apache
   MySQL
  
3. Copy the project folder:
   ART_pricing_system
   into:
   C:\xampp\htdocs\
   
4. Open phpMyAdmin
   Create a database named:
   art_pricing_db
   Open browser and run:
   http://localhost/ART_pricing_system/

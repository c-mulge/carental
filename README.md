# Project Report: Car Rental System

## Introduction

The Car Rental System is a web-based application designed to facilitate the process of renting cars online. This system allows users to register, log in, browse available cars, book cars, and make payments. Additionally, it provides an admin interface for managing cars, bookings, and users.

## Objectives

- To provide a user-friendly platform for renting cars online.
- To streamline the car rental process for both users and administrators.
- To ensure secure and efficient management of user data and bookings.

## Features

### User Features

1. **User Registration and Login**: Users can create an account and log in to access the system.
2. **Car Browsing**: Users can browse available cars and view details such as price, fuel type, and capacity.
3. **Car Booking**: Users can book cars by selecting pickup and drop-off locations, dates, and other details.
4. **Payment Processing**: Users can make payments for their bookings using secure payment methods.
5. **Feedback Submission**: Users can provide feedback on their rental experience.

### Admin Features

1. **Admin Registration and Login**: Admins can create an account and log in to access the admin dashboard.
2. **Car Management**: Admins can add, update, and delete car details.
3. **Booking Management**: Admins can view and manage all bookings.
4. **User Management**: Admins can view and manage user details.
5. **Feedback Management**: Admins can view user feedback.

## System Architecture

The Car Rental System follows a three-tier architecture:

1. **Presentation Layer**: This layer includes the user interface components such as HTML, CSS, and JavaScript. It is responsible for displaying the web pages and handling user interactions.
2. **Business Logic Layer**: This layer includes the PHP scripts that handle the core functionality of the system, such as user authentication, car booking, and payment processing.
3. **Data Access Layer**: This layer includes the database and SQL queries used to store and retrieve data. The system uses MySQL as the database management system.

## Database Design

The database for the Car Rental System consists of the following tables:

- **admin**: Stores admin details.
- **booking**: Stores booking details.
- **cars**: Stores car details.
- **feedback**: Stores user feedback.
- **payment**: Stores payment details.
- **users**: Stores user details.

### Table Structures

- **admin**:
  ```sql
  CREATE TABLE `admin` (
    `ADMIN_ID` varchar(255) NOT NULL,
    `ADMIN_NAME` varchar(255) NOT NULL,
    `ADMIN_EMAIL` varchar(255) NOT NULL,
    `ADMIN_PASSWORD` varchar(255) NOT NULL,
    PRIMARY KEY (`ADMIN_ID`),
    UNIQUE KEY `ADMIN_EMAIL` (`ADMIN_EMAIL`)
  );
  ```

- **booking**:
  ```sql
  CREATE TABLE `booking` (
    `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT,
    `CAR_ID` int(11) NOT NULL,
    `EMAIL` varchar(255) NOT NULL,
    `BOOK_PLACE` varchar(255) NOT NULL,
    `BOOK_DATE` date NOT NULL,
    `DURATION` int(11) NOT NULL,
    `PHONE_NUMBER` bigint(20) NOT NULL,
    `DESTINATION` varchar(255) NOT NULL,
    `RETURN_DATE` date NOT NULL,
    `PRICE` int(11) NOT NULL,
    `BOOK_STATUS` varchar(255) NOT NULL DEFAULT 'UNDER PROCESSING',
    PRIMARY KEY (`BOOK_ID`),
    KEY `CAR_ID` (`CAR_ID`),
    KEY `EMAIL` (`EMAIL`),
    CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE
  );
  ```

- **cars**:
  ```sql
  CREATE TABLE `cars` (
    `CAR_ID` int(11) NOT NULL AUTO_INCREMENT,
    `CAR_NAME` varchar(255) NOT NULL,
    `FUEL_TYPE` varchar(255) NOT NULL,
    `CAPACITY` int(11) NOT NULL,
    `PRICE` int(11) NOT NULL,
    `CAR_IMG` varchar(255) NOT NULL,
    `AVAILABLE` varchar(255) NOT NULL,
    PRIMARY KEY (`CAR_ID`)
  );
  ```

- **feedback**:
  ```sql
  CREATE TABLE `feedback` (
    `FED_ID` int(11) NOT NULL AUTO_INCREMENT,
    `EMAIL` varchar(255) NOT NULL,
    `COMMENT` text NOT NULL,
    PRIMARY KEY (`FED_ID`),
    KEY `TEST` (`EMAIL`),
    CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE
  );
  ```

- **payment**:
  ```sql
  CREATE TABLE `payment` (
    `PAY_ID` int(11) NOT NULL AUTO_INCREMENT,
    `BOOK_ID` int(11) NOT NULL,
    `CARD_NO` varchar(255) NOT NULL,
    `EXP_DATE` varchar(255) NOT NULL,
    `CVV` int(11) NOT NULL,
    `PRICE` int(11) NOT NULL,
    PRIMARY KEY (`PAY_ID`),
    UNIQUE KEY `BOOK_ID` (`BOOK_ID`),
    CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE
  );
  ```

- **users**:
  ```sql
  CREATE TABLE `users` (
    `FNAME` varchar(255) NOT NULL,
    `LNAME` varchar(255) NOT NULL,
    `EMAIL` varchar(255) NOT NULL,
    `LIC_NUM` varchar(255) NOT NULL,
    `PHONE_NUMBER` bigint(11) NOT NULL,
    `PASSWORD` varchar(255) NOT NULL,
    `GENDER` varchar(255) NOT NULL,
    PRIMARY KEY (`EMAIL`)
  );
  ```

## Implementation

### User Registration and Login

The user registration and login functionality is implemented using PHP and MySQL. The registration form collects user details and stores them in the `users` table. The login form verifies the user's credentials and starts a session if the credentials are valid.

### Car Browsing and Booking

Users can browse available cars on the home page. The car details are fetched from the `cars` table. When a user books a car, the booking details are stored in the `booking` table, and the availability status of the car is updated.

### Payment Processing

The payment processing functionality is implemented using PHP. When a user makes a payment, the payment details are stored in the `payment` table, and the booking status is updated.

### Admin Dashboard

The admin dashboard provides an interface for managing cars, bookings, and users. Admins can add, update, and delete car details, view and manage bookings, and view user details and feedback.

## Security

The Car Rental System includes several security measures to protect user data and ensure secure transactions:

- **Password Hashing**: User and admin passwords are hashed using the `password_hash` function before storing them in the database.
- **Input Validation**: User inputs are validated to prevent SQL injection and other attacks.
- **Session Management**: User sessions are managed securely to prevent unauthorized access.

## Conclusion

The Car Rental System provides a comprehensive solution for renting cars online. It offers a user-friendly interface, secure transactions, and efficient management of car rentals. This system can be further enhanced with additional features such as real-time availability updates, advanced search options, and integration with third-party payment gateways.

## Future Enhancements

- **Real-Time Availability**: Implement real-time updates for car availability.
- **Advanced Search**: Add advanced search options for users to filter cars based on various criteria.
- **Third-Party Integration**: Integrate with third-party payment gateways for more payment options.
- **Mobile App**: Develop a mobile app for the Car Rental System to provide a seamless experience for users on the go.

## References

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Bootstrap Documentation](https://getbootstrap.com/docs/4.1/getting-started/introduction/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2020 at 06:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us_content_master`
--

CREATE TABLE `about_us_content_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `background_check_list_master`
--

CREATE TABLE `background_check_list_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_check_title` varchar(90) NOT NULL,
  `description` varchar(90) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bank_statement_info`
--

CREATE TABLE `bank_statement_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `bank_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_holder_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_branch` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attached_document` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `review_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0,
  `assign_users_ids` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_statement_info`
--

INSERT INTO `bank_statement_info` (`id`, `user_id`, `client_id`, `application_id`, `bank_name`, `bank_holder_name`, `account_no`, `bank_branch`, `attached_document`, `status`, `created_at`, `updated_at`, `review_comment`, `is_completed`, `assign_users_ids`) VALUES
(2, 1, NULL, 1590564666, 'SBI', 'kjhjkh', '897987897', 'hjhjkjk', NULL, 1, '2020-06-26 06:22:36', '0000-00-00 00:00:00', 'fhfghgfhgfh', 2, NULL),
(8, 1, NULL, 1594629436, 'SBI', 'dfgdfgd', '6786767868', 'Noida', NULL, 1, '2020-07-13 09:44:45', '2020-07-13 08:55:21', 'hhhhhh', 1, NULL),
(10, 1, NULL, 1595039995, 'hghghjhg', 'jhjkhj', '787897897987', 'jhjkhjk', NULL, 1, '2020-07-18 03:08:57', '2020-07-18 03:08:57', NULL, 0, NULL),
(11, 1, NULL, 1595056660, 'rtyrytryr', 'bnmbbm', '878798789', 'bmbmnb', NULL, 1, '2020-07-20 04:13:16', '2020-07-18 07:39:45', 'tytryryry', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_statement_info_check`
--

CREATE TABLE `bank_statement_info_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `bank_statement_info_id` int(11) DEFAULT NULL,
  `is_bank_name_correct` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_bank_branch_correct` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_bank_account_correct` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_bank_holder_name_correct` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attached_document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifier_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifier_designation` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifier_remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `assign_users_ids` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_statement_info_check`
--

INSERT INTO `bank_statement_info_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `bank_statement_info_id`, `is_bank_name_correct`, `is_bank_branch_correct`, `is_bank_account_correct`, `is_bank_holder_name_correct`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`, `assign_users_ids`) VALUES
(2, 1, NULL, 1590564666, 'fghfh', 2, 2, '', '2', '1', '1', '', 'dgfg', 'fdfdgd', 'srrete', 1, 1, '2020-06-26 12:42:03', '2020-06-26 12:42:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `state_id`) VALUES
(3335, 'Hyderabad', 732),
(3336, 'Vishakhapatnam', 732),
(3337, 'Vijayawada', 732),
(3338, 'Guntur', 732),
(3339, 'Warangal', 732),
(3340, 'Rajahmundry', 732),
(3341, 'Nellore', 732),
(3342, 'Kakinada', 732),
(3343, 'Nizamabad', 732),
(3344, 'Kurnool', 732),
(3345, 'Ramagundam', 732),
(3346, 'Eluru', 732),
(3347, 'Kukatpalle', 732),
(3348, 'Anantapur', 732),
(3349, 'Tirupati', 732),
(3350, 'Secunderabad', 732),
(3351, 'Vizianagaram', 732),
(3352, 'Machilipatnam (Masulipatam)', 732),
(3353, 'Lalbahadur Nagar', 732),
(3354, 'Karimnagar', 732),
(3355, 'Tenali', 732),
(3356, 'Adoni', 732),
(3357, 'Proddatur', 732),
(3358, 'Chittoor', 732),
(3359, 'Khammam', 732),
(3360, 'Malkajgiri', 732),
(3361, 'Cuddapah', 732),
(3362, 'Bhimavaram', 732),
(3363, 'Nandyal', 732),
(3364, 'Mahbubnagar', 732),
(3365, 'Guntakal', 732),
(3366, 'Qutubullapur', 732),
(3367, 'Hindupur', 732),
(3368, 'Gudivada', 732),
(3369, 'Ongole', 732),
(3370, 'Guwahati (Gauhati)', 733),
(3371, 'Dibrugarh', 733),
(3372, 'Silchar', 733),
(3373, 'Nagaon', 733),
(3374, 'Patna', 734),
(3375, 'Gaya', 734),
(3376, 'Bhagalpur', 734),
(3377, 'Muzaffarpur', 734),
(3378, 'Darbhanga', 734),
(3379, 'Bihar Sharif', 734),
(3380, 'Arrah (Ara)', 734),
(3381, 'Katihar', 734),
(3382, 'Munger (Monghyr)', 734),
(3383, 'Chapra', 734),
(3384, 'Sasaram', 734),
(3385, 'Dehri', 734),
(3386, 'Bettiah', 734),
(3387, 'Chandigarh', 735),
(3388, 'Raipur', 736),
(3389, 'Bhilai', 736),
(3390, 'Bilaspur', 736),
(3391, 'Durg', 736),
(3392, 'Raj Nandgaon', 736),
(3393, 'Korba', 736),
(3394, 'Raigarh', 736),
(3395, 'Delhi', 737),
(3396, 'New Delhi', 737),
(3397, 'Delhi Cantonment', 737),
(3398, 'Ahmedabad', 738),
(3399, 'Surat', 738),
(3400, 'Vadodara (Baroda)', 738),
(3401, 'Rajkot', 738),
(3402, 'Bhavnagar', 738),
(3403, 'Jamnagar', 738),
(3404, 'Nadiad', 738),
(3405, 'Bharuch (Broach)', 738),
(3406, 'Junagadh', 738),
(3407, 'Navsari', 738),
(3408, 'Gandhinagar', 738),
(3409, 'Veraval', 738),
(3410, 'Porbandar', 738),
(3411, 'Anand', 738),
(3412, 'Surendranagar', 738),
(3413, 'Gandhidham', 738),
(3414, 'Bhuj', 738),
(3415, 'Godhra', 738),
(3416, 'Patan', 738),
(3417, 'Morvi', 738),
(3418, 'Vejalpur', 738),
(3419, 'Faridabad', 739),
(3420, 'Rohtak', 739),
(3421, 'Panipat', 739),
(3422, 'Karnal', 739),
(3423, 'Hisar (Hissar)', 739),
(3424, 'Yamuna Nagar', 739),
(3425, 'Sonipat (Sonepat)', 739),
(3426, 'Gurgaon', 739),
(3427, 'Sirsa', 739),
(3428, 'Ambala', 739),
(3429, 'Bhiwani', 739),
(3430, 'Ambala Sadar', 739),
(3431, 'Srinagar', 740),
(3432, 'Jammu', 740),
(3433, 'Ranchi', 741),
(3434, 'Jamshedpur', 741),
(3435, 'Bokaro Steel City', 741),
(3436, 'Dhanbad', 741),
(3437, 'Purnea (Purnia)', 741),
(3438, 'Mango', 741),
(3439, 'Hazaribag', 741),
(3440, 'Purulia', 741),
(3441, 'Bangalore', 742),
(3442, 'Hubli-Dharwad', 742),
(3443, 'Mysore', 742),
(3444, 'Belgaum', 742),
(3445, 'Gulbarga', 742),
(3446, 'Mangalore', 742),
(3447, 'Davangere', 742),
(3448, 'Bellary', 742),
(3449, 'Bijapur', 742),
(3450, 'Shimoga', 742),
(3451, 'Raichur', 742),
(3452, 'Timkur', 742),
(3453, 'Gadag Betigeri', 742),
(3454, 'Mandya', 742),
(3455, 'Bidar', 742),
(3456, 'Hospet', 742),
(3457, 'Hassan', 742),
(3458, 'Cochin (Kochi)', 743),
(3459, 'Thiruvananthapuram (Trivandrum', 743),
(3460, 'Calicut (Kozhikode)', 743),
(3461, 'Allappuzha (Alleppey)', 743),
(3462, 'Kollam (Quilon)', 743),
(3463, 'Palghat (Palakkad)', 743),
(3464, 'Tellicherry (Thalassery)', 743),
(3465, 'Indore', 744),
(3466, 'Bhopal', 744),
(3467, 'Jabalpur', 744),
(3468, 'Gwalior', 744),
(3469, 'Ujjain', 744),
(3470, 'Sagar', 744),
(3471, 'Ratlam', 744),
(3472, 'Burhanpur', 744),
(3473, 'Dewas', 744),
(3474, 'Murwara (Katni)', 744),
(3475, 'Satna', 744),
(3476, 'Morena', 744),
(3477, 'Khandwa', 744),
(3478, 'Rewa', 744),
(3479, 'Bhind', 744),
(3480, 'Shivapuri', 744),
(3481, 'Guna', 744),
(3482, 'Mandasor', 744),
(3483, 'Damoh', 744),
(3484, 'Chhindwara', 744),
(3485, 'Vidisha', 744),
(3486, 'Mumbai (Bombay)', 745),
(3487, 'Nagpur', 745),
(3488, 'Pune', 745),
(3489, 'Kalyan', 745),
(3490, 'Thane (Thana)', 745),
(3491, 'Nashik (Nasik)', 745),
(3492, 'Solapur (Sholapur)', 745),
(3493, 'Shambajinagar (Aurangabad)', 745),
(3494, 'Pimpri-Chinchwad', 745),
(3495, 'Amravati', 745),
(3496, 'Kolhapur', 745),
(3497, 'Bhiwandi', 745),
(3498, 'Ulhasnagar', 745),
(3499, 'Malegaon', 745),
(3500, 'Akola', 745),
(3501, 'New Bombay', 745),
(3502, 'Dhule (Dhulia)', 745),
(3503, 'Nanded (Nander)', 745),
(3504, 'Jalgaon', 745),
(3505, 'Chandrapur', 745),
(3506, 'Ichalkaranji', 745),
(3507, 'Latur', 745),
(3508, 'Sangli', 745),
(3509, 'Parbhani', 745),
(3510, 'Ahmadnagar', 745),
(3511, 'Mira Bhayandar', 745),
(3512, 'Jalna', 745),
(3513, 'Bhusawal', 745),
(3514, 'Miraj', 745),
(3515, 'Bhir (Bid)', 745),
(3516, 'Gondiya', 745),
(3517, 'Yeotmal (Yavatmal)', 745),
(3518, 'Wardha', 745),
(3519, 'Achalpur', 745),
(3520, 'Satara', 745),
(3521, 'Imphal', 746),
(3522, 'Shillong', 747),
(3523, 'Aizawl', 748),
(3524, 'Bhubaneswar', 749),
(3525, 'Kataka (Cuttack)', 749),
(3526, 'Raurkela', 749),
(3527, 'Brahmapur', 749),
(3528, 'Raurkela Civil Township', 749),
(3529, 'Sambalpur', 749),
(3530, 'Puri', 749),
(3531, 'Pondicherry', 750),
(3532, 'Ludhiana', 751),
(3533, 'Amritsar', 751),
(3534, 'Jalandhar (Jullundur)', 751),
(3535, 'Patiala', 751),
(3536, 'Bhatinda (Bathinda)', 751),
(3537, 'Pathankot', 751),
(3538, 'Hoshiarpur', 751),
(3539, 'Moga', 751),
(3540, 'Abohar', 751),
(3541, 'Lahore', 751),
(3542, 'Faisalabad', 751),
(3543, 'Rawalpindi', 751),
(3544, 'Multan', 751),
(3545, 'Gujranwala', 751),
(3546, 'Sargodha', 751),
(3547, 'Sialkot', 751),
(3548, 'Bahawalpur', 751),
(3549, 'Jhang', 751),
(3550, 'Sheikhupura', 751),
(3551, 'Gujrat', 751),
(3552, 'Kasur', 751),
(3553, 'Rahim Yar Khan', 751),
(3554, 'Sahiwal', 751),
(3555, 'Okara', 751),
(3556, 'Wah', 751),
(3557, 'Dera Ghazi Khan', 751),
(3558, 'Chiniot', 751),
(3559, 'Kamoke', 751),
(3560, 'Mandi Burewala', 751),
(3561, 'Jhelum', 751),
(3562, 'Sadiqabad', 751),
(3563, 'Khanewal', 751),
(3564, 'Hafizabad', 751),
(3565, 'Muzaffargarh', 751),
(3566, 'Khanpur', 751),
(3567, 'Gojra', 751),
(3568, 'Bahawalnagar', 751),
(3569, 'Muridke', 751),
(3570, 'Pak Pattan', 751),
(3571, 'Jaranwala', 751),
(3572, 'Chishtian Mandi', 751),
(3573, 'Daska', 751),
(3574, 'Mandi Bahauddin', 751),
(3575, 'Ahmadpur East', 751),
(3576, 'Kamalia', 751),
(3577, 'Vihari', 751),
(3578, 'Wazirabad', 751),
(3579, 'Jaipur', 752),
(3580, 'Jodhpur', 752),
(3581, 'Kota', 752),
(3582, 'Bikaner', 752),
(3583, 'Ajmer', 752),
(3584, 'Udaipur', 752),
(3585, 'Alwar', 752),
(3586, 'Bhilwara', 752),
(3587, 'Ganganagar', 752),
(3588, 'Bharatpur', 752),
(3589, 'Sikar', 752),
(3590, 'Pali', 752),
(3591, 'Beawar', 752),
(3592, 'Tonk', 752),
(3593, 'Chennai (Madras)', 753),
(3594, 'Madurai', 753),
(3595, 'Coimbatore', 753),
(3596, 'Tiruchirapalli', 753),
(3597, 'Salem', 753),
(3598, 'Tiruppur (Tirupper)', 753),
(3599, 'Ambattur', 753),
(3600, 'Thanjavur', 753),
(3601, 'Tuticorin', 753),
(3602, 'Nagar Coil', 753),
(3603, 'Avadi', 753),
(3604, 'Dindigul', 753),
(3605, 'Vellore', 753),
(3606, 'Tiruvottiyur', 753),
(3607, 'Erode', 753),
(3608, 'Cuddalore', 753),
(3609, 'Kanchipuram', 753),
(3610, 'Kumbakonam', 753),
(3611, 'Tirunelveli', 753),
(3612, 'Alandur', 753),
(3613, 'Neyveli', 753),
(3614, 'Rajapalaiyam', 753),
(3615, 'Pallavaram', 753),
(3616, 'Tiruvannamalai', 753),
(3617, 'Tambaram', 753),
(3618, 'Valparai', 753),
(3619, 'Pudukkottai', 753),
(3620, 'Palayankottai', 753),
(3621, 'Agartala', 754),
(3622, 'Kanpur', 755),
(3623, 'Lucknow', 755),
(3624, 'Varanasi (Benares)', 755),
(3625, 'Agra', 755),
(3626, 'Allahabad', 755),
(3627, 'Meerut', 755),
(3628, 'Bareilly', 755),
(3629, 'Gorakhpur', 755),
(3630, 'Aligarh', 755),
(3631, 'Ghaziabad', 755),
(3632, 'Moradabad', 755),
(3633, 'Saharanpur', 755),
(3634, 'Jhansi', 755),
(3635, 'Rampur', 755),
(3636, 'Muzaffarnagar', 755),
(3637, 'Shahjahanpur', 755),
(3638, 'Mathura', 755),
(3639, 'Firozabad', 755),
(3640, 'Farrukhabad-cum-Fatehgarh', 755),
(3641, 'Mirzapur-cum-Vindhyachal', 755),
(3642, 'Sambhal', 755),
(3643, 'Noida', 755),
(3644, 'Hapur', 755),
(3645, 'Amroha', 755),
(3646, 'Maunath Bhanjan', 755),
(3647, 'Jaunpur', 755),
(3648, 'Bahraich', 755),
(3649, 'Rae Bareli', 755),
(3650, 'Bulandshahr', 755),
(3651, 'Faizabad', 755),
(3652, 'Etawah', 755),
(3653, 'Sitapur', 755),
(3654, 'Fatehpur', 755),
(3655, 'Budaun', 755),
(3656, 'Hathras', 755),
(3657, 'Unnao', 755),
(3658, 'Pilibhit', 755),
(3659, 'Gonda', 755),
(3660, 'Modinagar', 755),
(3661, 'Orai', 755),
(3662, 'Banda', 755),
(3663, 'Meerut Cantonment', 755),
(3664, 'Kanpur Cantonment', 755),
(3665, 'Dehra Dun', 756),
(3666, 'Hardwar (Haridwar)', 756),
(3667, 'Haldwani-cum-Kathgodam', 756),
(3668, 'Calcutta [Kolkata]', 757),
(3669, 'Haora (Howrah)', 757),
(3670, 'Durgapur', 757),
(3671, 'Bhatpara', 757),
(3672, 'Panihati', 757),
(3673, 'Kamarhati', 757),
(3674, 'Asansol', 757),
(3675, 'Barddhaman (Burdwan)', 757),
(3676, 'South Dum Dum', 757),
(3677, 'Barahanagar (Baranagar)', 757),
(3678, 'Siliguri (Shiliguri)', 757),
(3679, 'Bally', 757),
(3680, 'Kharagpur', 757),
(3681, 'Burnpur', 757),
(3682, 'Uluberia', 757),
(3683, 'Hugli-Chinsurah', 757),
(3684, 'Raiganj', 757),
(3685, 'North Dum Dum', 757),
(3686, 'Dabgram', 757),
(3687, 'Ingraj Bazar (English Bazar)', 757),
(3688, 'Serampore', 757),
(3689, 'Barrackpur', 757),
(3690, 'Naihati', 757),
(3691, 'Midnapore (Medinipur)', 757),
(3692, 'Navadwip', 757),
(3693, 'Krishnanagar', 757),
(3694, 'Chandannagar', 757),
(3695, 'Balurghat', 757),
(3696, 'Berhampore (Baharampur)', 757),
(3697, 'Bankura', 757),
(3698, 'Titagarh', 757),
(3699, 'Halisahar', 757),
(3700, 'Santipur', 757),
(3701, 'Kulti-Barakar', 757),
(3702, 'Barasat', 757),
(3703, 'Rishra', 757),
(3704, 'Basirhat', 757),
(3705, 'Uttarpara-Kotrung', 757),
(3706, 'North Barrackpur', 757),
(3707, 'Haldia', 757),
(3708, 'Habra', 757),
(3709, 'Kanchrapara', 757),
(3710, 'Champdani', 757),
(3711, 'Ashoknagar-Kalyangarh', 757),
(3712, 'Bansberia', 757),
(3713, 'Baidyabati', 757);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `corporate_mater`
--

CREATE TABLE `corporate_mater` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `corporate_name` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `landmark` varchar(90) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `website` varchar(150) NOT NULL,
  `remark` text NOT NULL,
  `brief_about` text NOT NULL,
  `upload_image` longtext NOT NULL,
  `upload_logo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(100, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `customer_id` int(11) NOT NULL,
  `customer_code` varchar(100) NOT NULL,
  `customer_name` varchar(150) DEFAULT NULL,
  `concerned_person` varchar(128) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `office_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `customer_group` varchar(100) NOT NULL,
  `gst_reg_number` varchar(100) NOT NULL,
  `customer_status` varchar(20) NOT NULL DEFAULT '0' COMMENT '0-Inactive 1= Active',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `company_name` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `pincode` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`customer_id`, `customer_code`, `customer_name`, `concerned_person`, `country`, `phone_number`, `office_no`, `email`, `state`, `city`, `region`, `customer_group`, `gst_reg_number`, `customer_status`, `created_on`, `company_name`, `address1`, `address2`, `pincode`) VALUES
(1, '4790', 'TATA Motors LTD. Prolife Business Unit', '', 'INDIA', '9800098000', '', '', 'Hyderabad', 'Hyderabad', '', '', '', '1', '2019-07-01 08:57:04', 'TATA Motors LTD', 'Hyderabad - 501401, State - Thurgau, State Code - 36', '', '501401'),
(2, '4640', 'TATA Motors LTD. Recon Business C/O Super Speed PVT, LTD.', '', 'INDIA', '9800098000', '', '', 'Tamil Nadu', 'Coimbatore', '', '', '', '1', '2019-07-01 08:57:16', 'TATA Motors LTD', 'Coimbatore - 641015, State - Tamil Nadu, State Code - 33', '', '641015'),
(3, '4780', 'TATA MOTORS LTD.', '', 'INDIA', '9800098000', '', '', 'Gujrat', 'Surat', '', '', '', '1', '2019-07-01 08:57:22', 'TATA Motors LTD', '138 - 2 Ambica Auto Sales & Services , P O Kathor, Surat', '', NULL),
(4, '4630', 'TML LKO Assembly Line', '', 'India', '8900980076', '', '', 'Uttar Pradesh', 'Lucknow', 'NORTH', '', '298721320923', '1', '2019-12-17 09:37:36', 'TATA MOTORS', 'Prolife Plant LKO', '', '226019'),
(9, '4630MS', 'TML LKO Machine Shop', '', 'India', '7654321488', '', '', 'Uttar Pradesh', 'Lucknow', 'NORTH', '', '32456789', '1', '2019-12-17 09:37:27', 'TATA MOTORS', 'Prolife Plant LKO', '', '226019'),
(10, '4630SM', 'TML LKO Super Market', '', 'India', '9087540987', '', '', 'Uttar Pradesh', 'Lucknow', 'NORTH', '', '1234567890', '1', '2019-12-17 09:37:21', 'TATA MOTORS', 'Prolife Plant LKO', '', '226019'),
(11, '4650', 'TATA MOTORS LTD DELHI', '', 'India', '', '', '', 'Delhi', 'Delhi', 'NORTH', '', '', '1', '2019-12-17 09:37:14', 'TATA MOTORS', 'GAZIPUR', 'PATPARGANJ', '110096'),
(12, '4460', 'TML_CO NDR WAREHOUSING PVT LTD', '', 'India', '9800098000', '', '', 'Howrah', 'ULUBERIA', 'EAST', '', '', '1', '2019-12-17 09:39:44', 'NDR WAREHOUSING PVT LTD', 'RAGHUDEVPUR EAST PANCHLA NH-6 ULUBERIA', '', '711322'),
(13, '4466', 'TATA MOTORS WAREHOUSE SANTOSH NAGAR PUNE', '', 'India', '9800098000', '', '', 'Maharashtra', 'Pune', 'WEST', '', '', '1', '2019-12-17 12:44:15', 'TATA MOTORS WAREHOUSE', 'SANTOSH NAGAR PUNE', '', '410501'),
(14, '4412', 'NORTHERN RESIONAL WAREHOUSE PALWAL HARYANA', '', 'India', '9800098000', '', '', 'HARYANA', 'PALWAL', 'NORTH', '', '', '1', '2019-12-17 09:39:44', 'NORTHERN RESIONAL WAREHOUSE PALWAL HARYANA', 'PALWAL HARYANA', '', '121105'),
(15, '4520', 'CPV RWH SOUTH BANGLORE KARNATAKA', '34545345', 'India', '9800098000', '345345', 'fd@hmail.com', 'Andhra Pradesh', 'Abohar', 'SOUTH', '15', '8888888888', '1', '2020-06-03 11:05:12', 'CPV RWH SOUTH BANGLORE KARNATAKA', 'rtyryr', '', '560100'),
(16, 'HIMADI0001', 'Himadi Solutions', 'Vivek IT', 'India', '9871404378', '9898989898', 'vikaspratap1803@gmail.com', 'Delhi', 'New Delhi', 'West', 'Software Owner', '212312312', '0', '2020-06-03 11:43:27', 'Himadi Solutions', 'Office No. 202 IInd Floor, DDA Lal Market,\r\nH Block , Vikas Puri', '', '110018'),
(17, '435', 'fgfdg', '76766', 'India', '6876876', '68768', 'ramji@gmail.com', 'Andhra Pradesh', 'Abohar', 'yiyiuy', 'yuiyiy', 'uyyiy', '0', '2020-06-03 06:07:17', 'uiyiy', 'gjgjg', '', 'ytyut'),
(18, '798797', 'tert', '78979', 'India', '78797', '897987', 'john@gmail.com', 'Andhra Pradesh', 'Abohar', 'hjkh', 'hhhhkh', 'jhgjhg', '0', '2020-06-03 06:11:37', 'hghjg', 'gjhg', '', 'ghjg');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'IT'),
(2, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `document_upload`
--

CREATE TABLE `document_upload` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_to` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_no` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_upload`
--

INSERT INTO `document_upload` (`id`, `user_id`, `client_id`, `application_id`, `title`, `related_to`, `document_no`, `filename`) VALUES
(3, 1, NULL, 1590388134, 'Adhar card', 'home_address', 'rttryrt', '64257B17-1D3F-FFF0-60B3-1B5D95868504.jpg'),
(4, 1, NULL, 1590388134, 'Adhar card', 'present_address', 'ewrwerwe', '64257B17-1D3F-FFF0-60B3-1B5D95868504.jpg'),
(10, 1, NULL, 1590388134, 'highschool', 'education', '123456A', '9B10B9D4-3402-884E-87A0-20AE55DC394B.jpg'),
(11, 1, NULL, 1590388134, 'intermediate', 'education', '75675', '8C256042-3343-D32A-F5F6-B4C6DA5F0CAE.jpg'),
(12, 1, NULL, 1590388134, 'graduation', 'education', '5454645', 'AFF0540B-11DE-71AE-DB18-8D24DD10306A.jpg'),
(13, 1, NULL, 1590388134, 'post graduation', 'education', '', ''),
(14, 1, NULL, 1590388134, 'diploma', 'education', '', ''),
(15, 1, NULL, 1590388134, '5353', 'employer', 'employer0', '3284AF93-6B35-647B-F804-3CCB14DB38A9.jpg'),
(16, 1, NULL, 1590388134, '', 'employer', 'employer1', ''),
(17, 1, NULL, 1590388134, '', 'employer', 'employer2', ''),
(19, 1, NULL, 1590388134, 'verification doc', 'police', '45646456', 'DECD22A8-68A8-31D3-1890-8D953B84EAA8.jpg'),
(20, 1, NULL, 1590388134, '', 'address_verification', 'Address Verification Docs0', '8892E67F-93E0-2987-22AD-C155E0F14E34.jpg'),
(21, 1, NULL, 1590388134, '', 'address_verification', 'Address Verification Docs1', ''),
(22, 1, NULL, 1590388134, 'highschool', 'verify_education', '', ''),
(23, 1, NULL, 1590388134, 'intermediate', 'verify_education', '', ''),
(24, 1, NULL, 1590388134, 'graduation', 'verify_education', '', ''),
(25, 1, NULL, 1590388134, 'post graduation', 'verify_education', '', ''),
(26, 1, NULL, 1590388134, 'diploma', 'verify_education', '', ''),
(27, 1, NULL, 1590394748, 'Adhar card', 'home_address', '5555555', 'D49E6E49-F83E-F76E-0048-19F7904F5868.jpg'),
(28, 1, NULL, 1590394748, 'Adhar card', 'present_address', '123456', 'D49E6E49-F83E-F76E-0048-19F7904F5868.jpg'),
(29, 1, NULL, 1590394748, 'highschool', 'education', '756567567', 'BA097044-0632-3731-9BB0-7CBD758CE49D.jpg'),
(30, 1, NULL, 1590394748, 'intermediate', 'education', '657567657', '381D8084-7386-1847-0B67-833F49A24599.jpg'),
(31, 1, NULL, 1590394748, 'graduation', 'education', '56756567', '27F13D67-E8B6-078A-532D-C219AF57FE57.jpg'),
(32, 1, NULL, 1590394748, 'post graduation', 'education', '6465756', '5BEC18D3-905D-0D6F-C1C4-037698930E27.jpg'),
(33, 1, NULL, 1590394748, 'diploma', 'education', '7567567567', '0EA4D940-25F0-A815-C993-B0A3F7891B19.jpg'),
(34, 1, NULL, 1590394748, 'employer0', 'employer', '4564564564', 'FF268A8A-DEC2-CA61-977E-1FBBBF7A58CE.jpg'),
(35, 1, NULL, 1590394748, 'employer1', 'employer', '67567567', '60E22564-D502-89F8-3239-EE6F9EE37740.jpg'),
(36, 1, NULL, 1590394748, 'employer2', 'employer', '', ''),
(37, 1, NULL, 1590394748, 'verification doc', 'police', '6456464564', '57BD4F9F-6FF8-3043-E02C-EF24B769D606.jpg'),
(38, 1, NULL, 1590475315, 'Adhar card', 'home_address', '', 'B8CBD39A-647F-7607-E80B-18C930E308CC.jpg'),
(39, 1, NULL, 1590475315, 'Adhar card', 'present_address', '54456', 'B8CBD39A-647F-7607-E80B-18C930E308CC.jpg'),
(40, 1, NULL, 1590564666, 'Pan card', 'home_address', '3454354', '6963FCD2-4F67-4F1F-F8AE-90DADB46F284.jpg'),
(41, 1, NULL, 1590564666, 'Adhar card', 'present_address', '64565', '6963FCD2-4F67-4F1F-F8AE-90DADB46F284.jpg'),
(47, 1, NULL, 1590564666, 'employer0', 'employer', '45667567', '0E273E09-4D5B-25F2-9792-6C1CE33C70BB.jpg'),
(48, 1, NULL, 1590564666, 'employer1', 'employer', '', ''),
(49, 1, NULL, 1590564666, 'employer2', 'employer', '', ''),
(50, 1, NULL, 1590564666, 'verification doc', 'police', '456456456456', '198D28A8-D1B1-EBBF-4C64-2F9D079BA272.jpg'),
(56, 1, NULL, 1590564666, 'highschool', 'education', '66575675', '932C1394-508D-5FA3-B8AB-436840D8BEEB.jpg'),
(57, 1, NULL, 1590564666, 'intermediate', 'education', '6756657', '7D8728C2-7874-5907-1A85-F4297BE36479.jpg'),
(58, 1, NULL, 1590564666, 'graduation', 'education', '45435', '6EB9A392-79AD-1155-1730-B85B5A98C4DF.jpg'),
(59, 1, NULL, 1590564666, 'post graduation', 'education', '6756756', 'F1939DE5-6806-D0F4-8531-E3B262B40D0D.jpg'),
(60, 1, NULL, 1590564666, 'diploma', 'education', '56567', 'A992242E-0902-D210-E01A-6CB1BCD752B3.jpg'),
(61, 1, NULL, 1590635214, 'Adhar card', 'home_address', '', ''),
(62, 1, NULL, 1590635214, 'Adhar card', 'present_address', '', ''),
(63, 1, NULL, 1590635214, 'highschool', 'education', '', ''),
(64, 1, NULL, 1590635214, 'intermediate', 'education', '', ''),
(65, 1, NULL, 1590635214, 'graduation', 'education', '', ''),
(66, 1, NULL, 1590635214, 'post graduation', 'education', '', ''),
(67, 1, NULL, 1590635214, 'diploma', 'education', '', ''),
(68, 1, NULL, 1590635214, 'employer0', 'employer', '', ''),
(69, 1, NULL, 1590635214, 'employer1', 'employer', '', ''),
(70, 1, NULL, 1590635214, 'employer2', 'employer', '', ''),
(71, 1, NULL, 1590635214, 'verification doc', 'police', '', ''),
(72, 1, NULL, 1590564666, '', 'address_verification', 'Address Verification Docs0', '46700E35-7246-29E5-CCEC-EFA52D91ADD5.jpg'),
(73, 1, NULL, 1590564666, '', 'address_verification', 'Address Verification Docs1', 'DA9DD220-3DF6-9A92-2F18-35E9D2E85F42.jpg'),
(74, 1, NULL, 1590564666, 'highschool', 'verify_education', '', ''),
(75, 1, NULL, 1590564666, 'intermediate', 'verify_education', '', ''),
(76, 1, NULL, 1590564666, 'graduation', 'verify_education', '', ''),
(77, 1, NULL, 1590564666, 'post graduation', 'verify_education', '', ''),
(78, 1, NULL, 1590564666, 'diploma', 'verify_education', '', ''),
(79, 1, NULL, 1591014038, 'Bank Statement', 'bank', '', 'AC583115-C648-E28C-09A1-650399892CE0.jpg'),
(80, 1, NULL, 1591014038, 'Bank Statement', 'bank', '34534535', '1BB7735E-352C-9388-CCD0-0866CD15695A.jpg'),
(82, 1, NULL, 1591014038, '34534535', 'bank_check', 'Bank Statement', ''),
(83, 1, NULL, 1590564666, '', 'bank_check', 'Bank Statement', 'F7EDDB89-80D0-794E-E034-4FD573323956.jpg'),
(84, 1, NULL, 1590564666, 'employer0', 'employer_verification', '', ''),
(85, 1, NULL, 1590564666, 'employer1', 'employer_verification', '', ''),
(86, 1, NULL, 1590564666, 'employer2', 'employer_verification', '', ''),
(87, 1, NULL, 1590564666, '', 'police_check', 'verification doc', ''),
(88, 1, NULL, 1590564666, 'CIBIL Statement', 'cibil', '67575', '1BB7735E-352C-9388-CCD0-0866CD15695A.jpg'),
(90, 1, NULL, 1590564666, '6576575', 'cibil_check', 'CIBIL Statement', '9ED65118-1454-55EC-CFFB-F4FEE884950C.jpg'),
(91, 1, NULL, 1590564666, '', 'cort_check', 'Cort Statement', ''),
(92, 1, NULL, 1590564666, '', 'drug_check', 'Drug Statement', ''),
(93, 1, NULL, 1591605773, 'Adhar card', 'home_address', '65756756', '4BD3E2E3-94BC-50E2-FC11-DD5C5548D989.jpg'),
(94, 1, NULL, 1591605773, 'Adhar card', 'present_address', '65756756', '4BD3E2E3-94BC-50E2-FC11-DD5C5548D989.jpg'),
(95, 1, NULL, 1591605773, 'highschool', 'education', '56756756', 'CC46DFEC-A54A-2641-CD10-360394754640.jpg'),
(96, 1, NULL, 1591605773, 'intermediate', 'education', '464564', '34E54CA9-9C4D-0E1B-1298-A5E39F3D30CA.jpg'),
(97, 1, NULL, 1591605773, 'graduation', 'education', '', ''),
(98, 1, NULL, 1591605773, 'post graduation', 'education', '', ''),
(99, 1, NULL, 1591605773, 'diploma', 'education', '', ''),
(100, 1, NULL, 1591605773, 'employer0', 'employer', '76876786', '2AE6D6F6-965D-AB01-1D00-549D8A05C40E.jpg'),
(101, 1, NULL, 1591605773, 'employer1', 'employer', '', ''),
(102, 1, NULL, 1591605773, 'employer2', 'employer', '', ''),
(103, 1, NULL, 1591605773, 'verification doc', 'police', '65756', '05FE84AA-E01B-A5B0-0BE3-3EC87CF5A9BF.jpg'),
(104, 1, NULL, 1591605773, 'Bank Statement', 'bank', '4564565464564', '3249E423-9C59-3E6C-CFDA-42101096C5BE.jpg'),
(105, 1, NULL, 1591605773, 'CIBIL Statement', 'cibil', '77777777', '8BC59AC1-11C7-0E1E-7098-D1B69E4D8CA6.jpg'),
(106, 1, NULL, 1591605773, '', 'address_verification', 'Address Verification Docs0', '4F697FF2-A5BF-837C-76C4-23B627170CB5.jpg'),
(107, 1, NULL, 1591605773, '', 'address_verification', 'Address Verification Docs1', 'F85A3D79-F654-9F95-63BD-BCB1F6995E68.jpg'),
(108, 1, NULL, 1591605773, 'highschool', 'verify_education', '', ''),
(109, 1, NULL, 1591605773, 'intermediate', 'verify_education', '', ''),
(110, 1, NULL, 1591605773, 'graduation', 'verify_education', '', ''),
(111, 1, NULL, 1591605773, 'post graduation', 'verify_education', '', ''),
(112, 1, NULL, 1591605773, 'diploma', 'verify_education', '', ''),
(113, 1, NULL, 1591605773, 'employer0', 'employer_verification', '6555765', '8C42C03E-5F8B-09D3-F5A8-4EDE34EC9759.jpg'),
(114, 1, NULL, 1591605773, 'employer1', 'employer_verification', '76786', '30217AEC-7C47-0396-D09A-1AF074B5ABE7.jpg'),
(115, 1, NULL, 1591605773, 'employer2', 'employer_verification', '', ''),
(116, 1, NULL, 1591605773, '786786', 'police_check', 'verification doc', '90C0C7BC-A03B-AD4F-5729-2E64451D5292.jpg'),
(117, 1, NULL, 1591605773, '5675757567567', 'bank_check', 'Bank Statement', '0DB38670-DAA3-B7DC-4956-6FB46BD05596.jpg'),
(118, 1, NULL, 1591605773, 'hhjhghjg', 'cibil_check', 'CIBIL Statement', '54CAAE86-59FC-10FD-D6FA-EB45C882F2AF.jpg'),
(119, 1, NULL, 1590564666, '', 'court_check', 'Court Statement', 'F6CFB9AF-41F8-F7ED-62A3-70BC5B2140F0.jpg'),
(120, 1, NULL, 1591605773, '', 'drug_check', 'Drug Statement', ''),
(121, 1, NULL, 1591699759, 'Bank Statement', 'bank', '6667867', '8E40951C-39C0-3CD1-CC61-A840CE69FAA5.jpg'),
(122, 1, NULL, 1592622870, 'Adhar card', 'home_address', '', '360A2B05-3727-9628-24B9-2E3AC7AB4BB0.jpg'),
(123, 1, NULL, 1592622870, 'Adhar card', 'present_address', '6786667878768', '360A2B05-3727-9628-24B9-2E3AC7AB4BB0.jpg'),
(124, 1, NULL, 1592622870, 'highschool', 'education', '657656576', '5EB09053-4DBF-7C2B-B1A3-2C52BCE249D2.jpg'),
(125, 1, NULL, 1592622870, 'intermediate', 'education', '', ''),
(126, 1, NULL, 1592622870, 'graduation', 'education', '', ''),
(127, 1, NULL, 1592622870, 'post graduation', 'education', '', ''),
(128, 1, NULL, 1592622870, 'diploma', 'education', '', ''),
(129, 1, NULL, 1592622870, 'employer0', 'employer', '76876', 'B6C55B62-9297-B3C7-CC29-9549F7B66438.jpg'),
(130, 1, NULL, 1592622870, 'employer1', 'employer', '', ''),
(131, 1, NULL, 1592622870, 'employer2', 'employer', '', ''),
(132, 1, NULL, 1592622870, 'verification doc', 'police', '879877', 'F2E26242-D634-7FDD-F066-2FE7949E9763.jpg'),
(133, 1, NULL, 1592622870, 'Bank Statement', 'bank', '646466', 'D5277A25-7E8F-54B2-9614-30F8F0259A3A.jpg'),
(134, 1, NULL, 1592622870, 'CIBIL Statement', 'cibil', '66668', '6BDED518-83B5-D877-4B67-158BD88482E7.jpg'),
(135, 1, NULL, 1590635214, 'Bank Statement', 'bank', '6646445645654', '06C015B7-AE99-8128-B0E8-124C021FE974.jpg'),
(136, 1, NULL, 1592622870, '', 'address_verification', 'Address Verification Docs0', ''),
(137, 1, NULL, 1592622870, '', 'address_verification', 'Address Verification Docs1', ''),
(138, 1, NULL, 1592622870, 'highschool', 'verify_education', '', ''),
(139, 1, NULL, 1592622870, 'intermediate', 'verify_education', '', ''),
(140, 1, NULL, 1592622870, 'graduation', 'verify_education', '', ''),
(141, 1, NULL, 1592622870, 'post graduation', 'verify_education', '', ''),
(142, 1, NULL, 1592622870, 'diploma', 'verify_education', '', ''),
(143, 1, NULL, 1594357768, 'Adhar card', 'home_address', '4564646', 'E985849E-6CD0-B050-AE69-081CFD28E74E.jpg'),
(144, 1, NULL, 1594357768, 'Adhar card', 'present_address', 'yryrtyy', 'E985849E-6CD0-B050-AE69-081CFD28E74E.jpg'),
(145, 1, NULL, 1594357768, 'highschool', 'education', '76876786876', '6BE5612C-86DB-EA03-3753-556B920C6B5B.jpg'),
(146, 1, NULL, 1594357768, 'intermediate', 'education', '', ''),
(147, 1, NULL, 1594357768, 'graduation', 'education', '', ''),
(148, 1, NULL, 1594357768, 'post graduation', 'education', '', ''),
(149, 1, NULL, 1594357768, 'diploma', 'education', '', ''),
(150, 1, NULL, 1594357768, 'employer0', 'employer', '8979797987', '7F4E96F9-C9C8-8F1C-E982-DA85C0EE1FED.jpg'),
(151, 1, NULL, 1594357768, 'employer1', 'employer', '66575665', '794A545A-AEA2-DA07-D7CB-0886984794CA.jpg'),
(152, 1, NULL, 1594357768, 'employer2', 'employer', '757556', '818930D9-7727-EC59-ABC1-F639052B39D4.jpg'),
(153, 1, NULL, 1594357768, 'verification doc', 'police', '6876876', '9316FC98-6682-DDFF-A9A4-6565BDC8B18F.jpg'),
(154, 1, NULL, 1594357768, 'Bank Statement', 'bank', '65757557', '38009379-962D-D552-B4BF-2BBDC49153B5.jpg'),
(155, 1, NULL, 1594357768, 'CIBIL Statement', 'cibil', 'tyrtyr', '24E6088F-31DC-412B-692C-6792ED96E2F6.jpg'),
(156, 1, NULL, 1594357768, '', 'address_verification', 'Address Verification Docs0', ''),
(157, 1, NULL, 1594357768, '', 'address_verification', 'Address Verification Docs1', ''),
(158, 1, NULL, 1594357768, 'highschool', 'verify_education', '', ''),
(159, 1, NULL, 1594357768, 'intermediate', 'verify_education', '', ''),
(160, 1, NULL, 1594357768, 'graduation', 'verify_education', '', ''),
(161, 1, NULL, 1594357768, 'post graduation', 'verify_education', '', ''),
(162, 1, NULL, 1594357768, 'diploma', 'verify_education', '', ''),
(163, 1, NULL, 1594357768, 'employer0', 'employer_verification', 'fgfhfgh', '8C9B415F-4ADA-F6CF-B07D-3DFC91C91EFD.jpg'),
(164, 1, NULL, 1594357768, 'employer1', 'employer_verification', '', ''),
(165, 1, NULL, 1594357768, 'employer2', 'employer_verification', '', ''),
(166, 1, NULL, 1594629436, 'Adhar card', 'home_address', '76765675', '3C6C8EBB-7FFB-6840-2AE3-8B831C6837AB.jpg'),
(167, 1, NULL, 1594629436, 'Adhar card', 'present_address', '78787987', '3C6C8EBB-7FFB-6840-2AE3-8B831C6837AB.jpg'),
(168, 1, NULL, 1594629436, 'highschool', 'education', '67567576565', '5116CBD4-1F99-600B-B699-6095CF3E54C2.jpg'),
(169, 1, NULL, 1594629436, 'intermediate', 'education', '78687786876', 'A51BAEE8-7393-892B-A5BF-C8B1040F4A8A.jpg'),
(170, 1, NULL, 1594629436, 'graduation', 'education', '', ''),
(171, 1, NULL, 1594629436, 'post graduation', 'education', '', ''),
(172, 1, NULL, 1594629436, 'diploma', 'education', '', ''),
(173, 1, NULL, 1594629436, 'employer0', 'employer', '87878', '3E78FB68-A0F9-09B1-7685-B4242B89417F.jpg'),
(174, 1, NULL, 1594629436, 'employer1', 'employer', '', ''),
(175, 1, NULL, 1594629436, 'employer2', 'employer', '', ''),
(176, 1, NULL, 1594629436, 'verification doc', 'police', '7876786', 'FEA1D4E8-7F02-CFCD-E1E1-CB07CCE3E85C.jpg'),
(177, 1, NULL, 1594629436, 'Bank Statement', 'bank', '6786767868', 'F1DA7E84-536F-D1CF-27C5-D2C659F9DDDF.jpg'),
(178, 1, NULL, 1594629436, 'CIBIL Statement', 'cibil', '54564545', '18CA6280-3BD3-4A53-4B2A-C90336B8DA76.jpg'),
(181, 1, NULL, 1594969049, 'Adhar card', 'home_address', '68686876', '378CEA07-4411-B626-114C-C5314CD2C4C5.jpg,C0F1AFAB-A3EB-1DAB-AD4F-C37DEAFA5C77.jpg,E72E37B0-5161-8769-ED58-4C18EE421546.jpg,0346E0A0-E367-519C-4402-D10D26673868.jpg,'),
(182, 1, NULL, 1594969049, 'Adhar card', 'present_address', '78687676', '378CEA07-4411-B626-114C-C5314CD2C4C5.jpg,C0F1AFAB-A3EB-1DAB-AD4F-C37DEAFA5C77.jpg,E72E37B0-5161-8769-ED58-4C18EE421546.jpg,0346E0A0-E367-519C-4402-D10D26673868.jpg,'),
(183, 1, NULL, 1594969049, 'highschool', 'education', '67575675', ''),
(184, 1, NULL, 1594969049, 'intermediate', 'education', '', ''),
(185, 1, NULL, 1594969049, 'graduation', 'education', '', ''),
(186, 1, NULL, 1594969049, 'post graduation', 'education', '', ''),
(187, 1, NULL, 1594969049, 'diploma', 'education', '', ''),
(188, 1, NULL, 1595036189, 'Adhar card', 'home_address', '766666876', 'F0552384-6A4E-2CF9-9CBB-77CE03465BC4.jpg,657D74E5-DFD4-F7E8-41E7-E15C46AAF7AD.jpg,8B40A0C6-8354-9D0D-F179-CC7D3F59CB8F.jpg,99B5B8B0-3EFF-79EB-4F1F-3592086EF60F.jpg,'),
(189, 1, NULL, 1595036189, 'Adhar card', 'present_address', '766768687', 'F0552384-6A4E-2CF9-9CBB-77CE03465BC4.jpg,657D74E5-DFD4-F7E8-41E7-E15C46AAF7AD.jpg,8B40A0C6-8354-9D0D-F179-CC7D3F59CB8F.jpg,99B5B8B0-3EFF-79EB-4F1F-3592086EF60F.jpg,'),
(190, 1, NULL, 1595036189, 'highschool', 'education', '687678678', 'ABCCB545-071C-5DEA-5340-B26A111E104F.jpg,CA7379A2-2CA6-1335-A606-48C6FA39090A.jpg,8473ABE7-7022-BA8D-6D4C-C00BAEC67F9C.jpg,4568CEC9-B621-FD0F-80A4-DE8684486856.jpg,'),
(191, 1, NULL, 1595036189, 'intermediate', 'education', '', ''),
(192, 1, NULL, 1595036189, 'graduation', 'education', '', ''),
(193, 1, NULL, 1595036189, 'post graduation', 'education', '', ''),
(194, 1, NULL, 1595036189, 'diploma', 'education', '', ''),
(195, 1, NULL, 1595036189, 'employer0', 'employer', '67866767', 'AE313E5F-17B3-D0FD-1B30-47FB21A24868.jpg'),
(196, 1, NULL, 1595036189, 'employer1', 'employer', '', '376780A8-30B3-933F-8762-BE5A76B26B4F.jpg'),
(197, 1, NULL, 1595036189, 'employer2', 'employer', '', '534D8C4C-5001-AD56-18E5-EE5AE6025465.jpg'),
(198, 1, NULL, 1595036189, 'employer0', 'employer', '67866767', ''),
(199, 1, NULL, 1595036189, 'employer1', 'employer', '', ''),
(200, 1, NULL, 1595036189, 'employer2', 'employer', '', ''),
(201, 1, NULL, 1595038588, 'Adhar card', 'home_address', '676686', 'D8D33ABB-39AB-2890-B4C0-EB3086AD4E12.jpg,910C808D-817E-0CCA-7C48-7A776A81B715.jpg,7B0F8B4C-CBB3-6250-874D-345CDCF9882F.jpg,1CD1B912-4D82-DA74-2B53-895AB38DAA8B.jpg,'),
(202, 1, NULL, 1595038588, 'Adhar card', 'present_address', '6766876', 'D8D33ABB-39AB-2890-B4C0-EB3086AD4E12.jpg,910C808D-817E-0CCA-7C48-7A776A81B715.jpg,7B0F8B4C-CBB3-6250-874D-345CDCF9882F.jpg,1CD1B912-4D82-DA74-2B53-895AB38DAA8B.jpg,'),
(203, 1, NULL, 1595038588, 'highschool', 'education', '6868766676', '43B9C9DB-9A39-1CC2-6D40-AD7344604EA1.jpg,59C6B2E5-7C74-F2D5-7D94-B7E11D6FBE6C.jpg,4493F226-4AE4-8B5A-B620-91066068EE14.jpg,'),
(204, 1, NULL, 1595038588, 'intermediate', 'education', '', ''),
(205, 1, NULL, 1595038588, 'graduation', 'education', '', ''),
(206, 1, NULL, 1595038588, 'post graduation', 'education', '', ''),
(207, 1, NULL, 1595038588, 'diploma', 'education', '', ''),
(208, 1, NULL, 1595038588, 'employer0', 'employer', '7678766676', '61CFA548-27EF-DC0C-4579-7A1A31BCA717.jpg,DB43E190-81AC-7C98-0C11-D647377AABC4.jpg,308556C2-8838-269A-D3E8-37F9E043E3EA.jpg,E5E07E7E-8409-10A3-61A0-976EC6C69E39.jpg,'),
(209, 1, NULL, 1595038588, 'employer1', 'employer', '', ''),
(210, 1, NULL, 1595038588, 'employer2', 'employer', '', ''),
(211, 1, NULL, 1595038588, 'employer0', 'employer', '7678766676', '88494668-319E-5105-A6AE-A7DD179666C9.jpg,2A105510-BC69-CDAE-5999-531405B201B6.jpg,283FD33C-3F94-5CDF-839F-BBA4EEE01719.jpg,7719A6E8-3DA4-CE72-F668-FA38551CDD13.jpg,'),
(212, 1, NULL, 1595038588, 'employer1', 'employer', '', ''),
(213, 1, NULL, 1595038588, 'employer2', 'employer', '', ''),
(214, 1, NULL, 1595039995, 'Adhar card', 'home_address', '6768766', '6CE45953-13D6-3CB9-7D52-4337B538B434.jpg,9D4758EC-BBF8-69C1-5A66-DB36C660B7DA.jpg,F067E5FB-4B2B-8793-73BB-25EE3B9F1FCC.jpg,C8AE05EA-13D1-67AB-3104-A16CFFA2B828.jpg,'),
(215, 1, NULL, 1595039995, 'Pan card', 'present_address', '768687', '6CE45953-13D6-3CB9-7D52-4337B538B434.jpg,9D4758EC-BBF8-69C1-5A66-DB36C660B7DA.jpg,F067E5FB-4B2B-8793-73BB-25EE3B9F1FCC.jpg,C8AE05EA-13D1-67AB-3104-A16CFFA2B828.jpg,'),
(216, 1, NULL, 1595039995, 'highschool', 'education', '7867668', '76CB8237-67FA-10E1-9FAA-FE2D73668065.jpg,BED184E0-BF11-3583-C715-29497B240417.jpg,2145F1DA-207D-F150-C397-5C11F0C8478E.jpg,6A465264-84AB-C998-A6BD-11D716607A25.jpg,'),
(217, 1, NULL, 1595039995, 'intermediate', 'education', '', ''),
(218, 1, NULL, 1595039995, 'graduation', 'education', '', ''),
(219, 1, NULL, 1595039995, 'post graduation', 'education', '', ''),
(220, 1, NULL, 1595039995, 'diploma', 'education', '', ''),
(221, 1, NULL, 1595039995, 'employer0', 'employer', '76767676786', '803B681C-FDC4-B501-A3F9-68982873B6E7.jpg,FC060092-10B8-12E7-7C24-EFDAD8B90D23.jpg,5B7C8CA0-D652-3FDE-AFF6-661273902C2F.jpg,B9C2B709-A562-E729-28FC-6C87429E3D8B.jpg,'),
(222, 1, NULL, 1595039995, 'employer1', 'employer', '', ''),
(223, 1, NULL, 1595039995, 'employer2', 'employer', '', ''),
(224, 1, NULL, 1595039995, 'verification doc', 'police', '788778798', ''),
(225, 1, NULL, 1595039995, 'verification doc', 'police', '788778798', 'DB899446-04F6-31C3-3B52-23F0494AD51F.jpg,0DE7584F-B62C-A490-87F7-8EE1A06E7FBA.jpg,E9F52C70-7836-365D-20B2-98EFD1E50A0F.jpg,4DCB0C2F-028A-8CB9-C4B1-B0273CFAA94B.jpg,'),
(226, 1, NULL, 1595039995, 'Bank Statement', 'bank', '787897897987', ''),
(227, 1, NULL, 1595039995, 'Bank Statement', 'bank', '787897897987', '2E28ED6A-87C7-0809-A98A-B7107D992EF5.pdf,'),
(228, 1, NULL, 1595039995, 'CIBIL Statement', 'cibil', '878989789', 'B32AB91F-93BC-F01E-6AA0-39E9618ACC1F.jpg'),
(229, 1, NULL, 1595056660, 'Adhar card', 'home_address', '79988798', 'BAF3C76B-F1D2-35C6-44DF-6E747B007859.jpg,33E97F3A-BEAF-1D12-2B65-E6E82CDC89A6.jpg,BD5CCE26-52AB-66CA-BE07-59BD1080D932.jpg,AB425911-E47E-953B-6C9D-1F997B018484.jpg,'),
(230, 1, NULL, 1595056660, 'Adhar card', 'present_address', 't67687687', 'BAF3C76B-F1D2-35C6-44DF-6E747B007859.jpg,33E97F3A-BEAF-1D12-2B65-E6E82CDC89A6.jpg,BD5CCE26-52AB-66CA-BE07-59BD1080D932.jpg,AB425911-E47E-953B-6C9D-1F997B018484.jpg,'),
(231, 1, NULL, 1595056660, 'highschool', 'education', '676687687678', 'AFD637FF-976F-2EE0-8C19-334715EAE6E7.jpg,E784352E-3DA1-A8C0-1C2F-D72773229782.jpg,4D24C008-34C6-330C-6AF1-6F22BDAD073D.jpg,9F71C755-AAE6-6241-4C2F-A7B377646882.jpg,'),
(232, 1, NULL, 1595056660, 'intermediate', 'education', '67867678', '5D90AB3A-8779-AC02-7DC0-62DCC77C5C1C.jpg,EEC96598-93F1-78E8-6147-2E5D35172025.jpg,8A21ECFA-8E66-BD85-B42E-F66B3E72AAE5.jpg,F7FAFE57-11FD-3247-FC16-44A38152D931.jpg,'),
(233, 1, NULL, 1595056660, 'graduation', 'education', '', ''),
(234, 1, NULL, 1595056660, 'post graduation', 'education', '', ''),
(235, 1, NULL, 1595056660, 'diploma', 'education', '', ''),
(236, 1, NULL, 1595056660, 'employer0', 'employer', '878978989', '948E2D56-3618-518F-C962-3B0335716271.jpg,135F0E39-A64D-6531-297C-DFE1F27326E5.jpg,80BAFEC0-3566-F9B5-49B0-33598C62AEA6.jpg,6FF9D563-9AA7-CD81-BAC6-D72958A8C18F.jpg,'),
(237, 1, NULL, 1595056660, 'employer1', 'employer', '', ''),
(238, 1, NULL, 1595056660, 'employer2', 'employer', '', ''),
(239, 1, NULL, 1595056660, 'verification doc', 'police', '78867676', 'DA64F6AC-1E3F-F263-6964-4E7357CF59C4.jpg,C683C345-F2A7-7820-5602-21CC0B293F56.jpg,E84206E0-EBD3-1601-D24A-63CD33339166.jpg,3756EEE6-62CB-6B44-6ED6-0837FE53E346.jpg,'),
(240, 1, NULL, 1595056660, 'Bank Statement', 'bank', '878798789', '066D2E67-9E58-AA2E-6BF1-64BB3606B3BE.pdf,'),
(241, 1, NULL, 1595056660, 'CIBIL Statement', 'cibil', 'uiui', 'BEA04E2E-03E6-E225-64A4-2A9C0DDEB055.jpg'),
(242, 1, NULL, 1595056660, '', 'address_verification', 'Address Verification Docs0', '4139D229-732C-C56D-C81A-2D1135018CC9.jpg'),
(243, 1, NULL, 1595056660, '', 'address_verification', 'Address Verification Docs1', 'B52F7493-F771-2182-2F60-1212CE6E7D32.jpg'),
(244, 1, NULL, 1595056660, 'highschool', 'verify_education', '', ''),
(245, 1, NULL, 1595056660, 'intermediate', 'verify_education', '', ''),
(246, 1, NULL, 1595056660, 'graduation', 'verify_education', '', ''),
(247, 1, NULL, 1595056660, 'post graduation', 'verify_education', '', ''),
(248, 1, NULL, 1595056660, 'diploma', 'verify_education', '', ''),
(249, 1, NULL, 1595056660, 'employer0', 'employer_verification', '77789798', '4122476E-B988-CBAD-9F6A-462CFBD02374.jpg'),
(250, 1, NULL, 1595056660, 'employer1', 'employer_verification', '', ''),
(251, 1, NULL, 1595056660, 'employer2', 'employer_verification', '', ''),
(252, 1, NULL, 1595056660, '76786786', 'police_check', 'verification doc', 'F970A590-09C3-1592-7649-74B35F4155A1.jpg'),
(253, 1, NULL, 1595056660, '878798789', 'bank_check', 'Bank Statement', '6685A750-49C0-8CC6-A776-D10DE3B8E95D.jpg'),
(254, 1, NULL, 1595056660, 'uuoi', 'cibil_check', 'CIBIL Statement', '8784F0EB-4356-58FE-FCDF-040CAEA4C6BC.jpg'),
(255, 1, NULL, 1595056660, '', 'court_check', 'Court Statement', '041980D4-8A03-EB84-57F1-298486C06B30.jpg'),
(256, 1, NULL, 1595056660, '', 'drug_check', 'Drug Statement', ''),
(257, 1, NULL, 1595056660, '', 'drug_check', 'Drug Statement', '331E98A6-A7C0-5BEA-17D0-D401C4CC3BFA.jpg'),
(258, 1, NULL, 1595056660, '', 'address_verification', 'Address Verification Docs0', ''),
(259, 1, NULL, 1595056660, '', 'address_verification', 'Address Verification Docs1', ''),
(260, 1, NULL, 1595056660, '', 'address_verification', 'Address Verification Docs0', '837AC1EC-41FF-A51E-4180-D38B2F4CF783.jpg,C3D5EA14-9C6D-608C-56EE-ED6B73AA0F77.jpg,8F512C06-8A45-DBD1-4350-984C28D5ED1B.jpg,4FCCD154-F735-F51D-CE99-EDCEB6DAD251.jpg,D254D5FA-7FAC-AE9F-EBBB-F1BD4C0033E8.jpg,63CA0ECF-EBA4-8DBA-B8F4-EF4105DCCBE6.jpg,86F307C2-9FBC-1A94-8D7E-D7D12DFC66F0.jpg,68AAF27C-6279-7C5D-D7BB-567DB77E8066.jpg,'),
(261, 1, NULL, 1595056660, '', 'address_verification', 'Address Verification Docs1', '0AE4C8FA-2B6E-76BA-1F71-A9EC3C8E8F23.jpg,E709B99C-8C36-2FA4-4E40-3DAF9AABABAD.jpg,912409ED-4C83-4205-B864-AEA2C4FEC488.jpg,25334D2F-2A4A-9924-5117-85B68DE4C0CE.jpg,3182F187-755E-8E1E-5463-505520D91F33.jpg,A5E8090A-4931-AE87-A185-A53654CAFC8B.jpg,2C366702-751B-9F97-04D2-B4541A0091A3.jpg,EC1E95FA-E07B-6815-80ED-553E2EC977A4.jpg,'),
(262, 1, NULL, 1595056660, 'employer0', 'employer_verification', '76786', 'E31BA42C-BB0F-2BF1-5071-735D754E6BD2.jpg,7D57D125-B07D-76BA-5041-EBA98EB210C2.jpg,'),
(263, 1, NULL, 1595056660, 'employer1', 'employer_verification', '', ''),
(264, 1, NULL, 1595056660, 'employer2', 'employer_verification', '', ''),
(265, 1, NULL, 1595056660, '', 'drug_check', 'Drug Statement', '9A51E39A-43D0-82B6-AEB6-0B169059E73C.jpg,34996EAA-DA3C-F359-9DD9-EA672CFDB9C2.jpg,B218EB4D-57DF-9FCE-8EDC-50F5DD43CE8A.jpg,7BDECA27-0427-C08E-C79B-67A87CEFF63D.jpg,344C89B5-BC90-F3AF-A9D3-E8CB17871274.jpg,');

-- --------------------------------------------------------

--
-- Table structure for table `drug_abuse_test_check`
--

CREATE TABLE `drug_abuse_test_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `panel` varchar(20) NOT NULL,
  `sample_collected` varchar(50) NOT NULL,
  `repport_status` varchar(40) NOT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remark` text NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drug_abuse_test_check`
--

INSERT INTO `drug_abuse_test_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `panel`, `sample_collected`, `repport_status`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1590564666, 'fgfdgdfg', 2, 'yytyu', 'tyutyu', '', '', 'utyutu', 'tyuytut', 'tyuytu', 0, 1, '2020-06-07 02:30:19', '2020-06-26 12:42:25'),
(5, 1, NULL, 1595056660, NULL, 0, 'yyuy', 'uuiy', '', '', 'hjkh', 'hkjhkj', 'jhkjh', 1, 1, '2020-07-20 11:05:19', '2020-07-20 11:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `email_notifications`
--

CREATE TABLE `email_notifications` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_address`
--

CREATE TABLE `employee_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `address_type` int(10) NOT NULL COMMENT '1=current 2=permanent',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0 COMMENT '0=In-completed ,\r\n1=Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_address`
--

INSERT INTO `employee_address` (`id`, `user_id`, `client_id`, `application_id`, `address`, `city`, `state`, `country`, `pin_code`, `landmark`, `address_type`, `status`, `created_at`, `updated_at`, `review_comment`, `is_completed`) VALUES
(1, 1, NULL, 1590564666, 'hjghg', 'Abohar', 'Andhra Pradesh', 'India', '687687', 'ghghjghg', 1, 1, '2020-05-27 07:48:33', '2020-06-10 07:25:34', '', 0),
(2, 1, NULL, 1590564666, 'gjhgg', 'Abohar', 'Andhra Pradesh', 'India', '687687', 'hkjh', 2, 1, '2020-05-27 07:48:33', '2020-06-10 07:25:34', '', 0),
(3, 1, NULL, 1590635214, 'hfghf', '[San CristÃ³bal de] la Laguna', 'Andhra Pradesh', 'India', '54564', 'fghfg', 1, 1, '2020-05-28 03:29:37', '2020-05-28 04:10:01', '', 0),
(4, 1, NULL, 1590635214, '', '[San CristÃ³bal de] la Laguna', 'Andhra Pradesh', 'India', '54564', '', 2, 1, '2020-05-28 03:29:37', '2020-05-28 04:10:01', '', 0),
(9, 1, NULL, 1594357768, 'hgdfjghkdghk', 'Adoni', 'Delhi', 'India', '6564564', 'jhjhjh', 1, 1, '2020-07-10 05:14:55', '2020-07-10 05:14:55', NULL, 0),
(10, 1, NULL, 1594357768, 'hfghf', 'Adoni', 'Chandigarh', 'India', '5456', 'hfgh', 2, 1, '2020-07-10 05:14:55', '2020-07-10 05:14:55', NULL, 0),
(11, 1, NULL, 1594629436, 'hgfhf', 'Abohar', 'Andhra Pradesh', 'India', '78787', 'hjjhjh', 1, 1, '2020-07-13 08:42:26', '2020-07-13 09:12:01', 'cccccccc', 2),
(12, 1, NULL, 1594629436, 'uyuyuy', 'Abohar', 'Andhra Pradesh', 'India', '76766', 'uyuyuy', 2, 1, '2020-07-13 08:42:26', '2020-07-13 09:12:01', 'ccccccccccccccccccc', 1),
(15, 1, NULL, 1594969049, 'iyyuy', 'Abohar', 'Andhra Pradesh', 'India', '67676', 'uyuiy', 1, 1, '2020-07-17 10:10:23', '2020-07-17 10:10:23', NULL, 0),
(16, 1, NULL, 1594969049, 'yyyt', 'Abohar', 'Andhra Pradesh', 'India', '67678', 'tyt', 2, 1, '2020-07-17 10:10:23', '2020-07-17 10:10:23', NULL, 0),
(17, 1, NULL, 1595036189, 'jhhhjh', 'Abohar', 'Andhra Pradesh', 'India', '7678687676', 'hjkhjh', 1, 1, '2020-07-18 01:41:36', '2020-07-18 01:41:36', NULL, 0),
(18, 1, NULL, 1595036189, 'uyuyyiu', 'Abohar', 'Andhra Pradesh', 'India', '76876767', 'yiuyuiy', 2, 1, '2020-07-18 01:41:36', '2020-07-18 01:41:36', NULL, 0),
(19, 1, NULL, 1595038588, 'hghjghg', 'Abohar', 'Andhra Pradesh', 'India', '78786', 'uhjhgh', 1, 1, '2020-07-18 02:22:00', '2020-07-18 02:22:00', NULL, 0),
(20, 1, NULL, 1595038588, 'uyuyuy', 'Abohar', 'Andhra Pradesh', 'India', '76766', 'uiyiuyi', 2, 1, '2020-07-18 02:22:00', '2020-07-18 02:22:00', NULL, 0),
(21, 1, NULL, 1595039995, 'jhjkhkj', 'Abohar', 'Andhra Pradesh', 'India', '78787', 'jhjkhjh', 1, 1, '2020-07-18 02:46:50', '2020-07-18 02:46:50', NULL, 0),
(22, 1, NULL, 1595039995, 'jhjkjh', 'Abohar', 'Andhra Pradesh', 'India', '87877', 'jjhhjk', 2, 1, '2020-07-18 02:46:50', '2020-07-18 02:46:50', NULL, 0),
(23, 1, NULL, 1595056660, 'hhjkj', 'Abohar', 'Andhra Pradesh', 'India', '8787', 'jhjhk', 1, 1, '2020-07-18 07:20:27', '2020-07-20 04:12:33', 'dfgdgd', 1),
(24, 1, NULL, 1595056660, 'ghjghg', 'Abohar', 'Andhra Pradesh', 'India', '89787', 'hjghjg', 2, 1, '2020-07-18 07:20:27', '2020-07-20 04:12:33', 'dfgdfgdfg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_address_check`
--

CREATE TABLE `employee_address_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `employee_address_id` int(11) NOT NULL,
  `accommodation_type` varchar(30) NOT NULL COMMENT 'Rented/Owned/Paying Guest',
  `how_many_years_candidate_is_residing` varchar(30) NOT NULL,
  `land_mark` varchar(50) NOT NULL,
  `document_type` varchar(50) NOT NULL,
  `verifier_relationship` varchar(50) NOT NULL,
  `sign_of_respondent` varchar(50) NOT NULL,
  `contact_of_respondent` varchar(20) NOT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remark` text NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_address_check`
--

INSERT INTO `employee_address_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `employee_address_id`, `accommodation_type`, `how_many_years_candidate_is_residing`, `land_mark`, `document_type`, `verifier_relationship`, `sign_of_respondent`, `contact_of_respondent`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1590564666, 'hhhhjj', 2, 1, 'Rented', '6', '', '', 'jjhjk', 'hjkhk', 'jkhjkh', '', 'jjkhkh', 'kjhjkh', 'kjhk', 1, 1, '2020-05-31 03:36:35', '2020-07-20 10:51:00'),
(2, 1, NULL, 1590564666, 'jjjjjj', 2, 2, 'Rented', '7', '', '', 'hghjgj', 'hgjhg', 'jg', '', 'hjg', 'jhg', 'hjg', 1, 1, '2020-05-31 03:36:35', '2020-07-20 10:51:00'),
(13, 1, NULL, 1595056660, NULL, 0, 23, 'Rented', '7', '', '', 'hjhjkh', 'hjkhjk', 'hkjhk', '', 'hjkhkh', 'jhkjh', 'hkjhkj', 1, 1, '2020-07-20 11:02:14', '2020-07-20 11:02:14'),
(14, 1, NULL, 1595056660, NULL, 0, 24, 'Rented', '8', '', '', 'jkkh', 'jhjkhjk', 'hjkhjk', '', 'hjkhkj', 'hkjh', 'jhjk', 1, 1, '2020-07-20 11:02:14', '2020-07-20 11:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `employee_cibil_check`
--

CREATE TABLE `employee_cibil_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `employee_cibil_info_id` int(11) DEFAULT NULL,
  `reference_number` varchar(50) DEFAULT NULL,
  `member_id` varchar(50) DEFAULT NULL,
  `score_name` varchar(50) DEFAULT NULL,
  `scoring_factor` text DEFAULT NULL,
  `score` varchar(50) DEFAULT NULL,
  `cibil_remark` text DEFAULT NULL,
  `dispute_remark` text DEFAULT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remark` text NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_cibil_check`
--

INSERT INTO `employee_cibil_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `employee_cibil_info_id`, `reference_number`, `member_id`, `score_name`, `scoring_factor`, `score`, `cibil_remark`, `dispute_remark`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, 1590564666, 'gfhfh', 2, 1, '67567', '66765', 'ghjgj', 'ghjghj', 'gfhgfh', 'yytu', 'tytry', '', 'tryry', 'tytryr', 'trty', 1, 1, '2020-06-02 13:00:41', '2020-06-26 12:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `employee_cibil_info`
--

CREATE TABLE `employee_cibil_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `pancard_no` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aadhar_no` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_income` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annual_income` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_and_gross_income` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attached_document` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `review_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0,
  `assign_users_ids` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_cibil_info`
--

INSERT INTO `employee_cibil_info` (`id`, `user_id`, `client_id`, `application_id`, `pancard_no`, `aadhar_no`, `mobile`, `email`, `occupation`, `monthly_income`, `annual_income`, `net_and_gross_income`, `attached_document`, `status`, `created_at`, `updated_at`, `review_comment`, `is_completed`, `assign_users_ids`) VALUES
(1, 1, NULL, 1590564666, 'ghf', 'hjjh', '8798787', 'ramji@gmail.com', 'gjhghjgh', '767', '97897', '787877', NULL, 1, '2020-06-08 09:56:01', '0000-00-00 00:00:00', 'cibil not verified', 2, NULL),
(5, 1, NULL, 1594629436, '54564545', 'yiuyuiyy', '67867866786', 'hghg@hgh.ccc', '656556', 'hgjhghjg', '878787', '8787', NULL, 1, '2020-07-13 09:44:53', '2020-07-13 09:09:20', 'iiiiiiiiiiii', 1, NULL),
(6, 1, NULL, 1595039995, '878989789', '7779879', '897979789', 'ramji@gmail.com', 'jhghgh', '8789789', '878977', '87897', NULL, 1, '2020-07-18 03:10:11', '2020-07-18 03:10:11', NULL, 0, NULL),
(7, 1, NULL, 1595056660, 'uiui', 'uiioio', '79889898989', 'raj@gmail.com', 'iuui', '77766', '7686876', '687687678', NULL, 1, '2020-07-20 04:13:23', '2020-07-18 07:40:58', 'tryryrtyry', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_court_record_check`
--

CREATE TABLE `employee_court_record_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `is_applicant_name_correct` varchar(20) NOT NULL,
  `is_father_name_correct` varchar(20) NOT NULL,
  `is_address_correct` varchar(20) NOT NULL,
  `found_record_all_india_court_for_civil` varchar(30) NOT NULL,
  `found_record_in_all_high_courts_of_india_for_civil` varchar(30) NOT NULL,
  `found_record_in_supreme_court_of_india_for_civil` varchar(30) NOT NULL,
  `found_record_in_all_session_courts_for_criminal` varchar(30) NOT NULL,
  `found_record_all_high_courts_of_india_for_criminal` varchar(30) NOT NULL,
  `found_record_in_supreme_court_of_india_for_criminal` varchar(30) NOT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remark` text NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_court_record_check`
--

INSERT INTO `employee_court_record_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `is_applicant_name_correct`, `is_father_name_correct`, `is_address_correct`, `found_record_all_india_court_for_civil`, `found_record_in_all_high_courts_of_india_for_civil`, `found_record_in_supreme_court_of_india_for_civil`, `found_record_in_all_session_courts_for_criminal`, `found_record_all_high_courts_of_india_for_criminal`, `found_record_in_supreme_court_of_india_for_criminal`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1590564666, 'gfhf', 2, '', '0', '1', 'yrtyr', 'rtyrty', 'rtyyry', 'rtyrtyr', 'rtytry', 'dtrt', '', 'ttryry', 'rty', 'rtyryr', 0, 1, '2020-06-07 01:49:51', '2020-06-26 12:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `employee_education_tbl`
--

CREATE TABLE `employee_education_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `college_institute` varchar(128) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `passing_year` varchar(128) NOT NULL,
  `roll_no` varchar(30) NOT NULL,
  `order_no` int(11) NOT NULL,
  `university_board` varchar(128) NOT NULL,
  `attached_document` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0 COMMENT '0=Completed,\r\n1=In-Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_education_tbl`
--

INSERT INTO `employee_education_tbl` (`id`, `user_id`, `client_id`, `application_id`, `college_institute`, `qualification`, `passing_year`, `roll_no`, `order_no`, `university_board`, `attached_document`, `address`, `city`, `state`, `country`, `pincode`, `landmark`, `status`, `created_at`, `updated_at`, `review_comment`, `is_completed`) VALUES
(26, 1, NULL, 1590564666, 'yrtyr', 'High School (10)', '2005', '87887', 1, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-05-27 09:23:09', '2020-06-10 07:16:19', '', 0),
(27, 1, NULL, 1590564666, '', 'Intermediate (10+2)', '0', '', 2, '', '', '', '', '', '', '', '', 1, '2020-05-27 09:23:09', '2020-06-10 07:16:19', '', 0),
(28, 1, NULL, 1590564666, '', 'Graduation', '0', '', 3, '', '', '', '', '', '', '', '', 1, '2020-05-27 09:23:09', '2020-06-10 07:16:19', '', 0),
(29, 1, NULL, 1590564666, '', 'Post Graduation', '0', '', 4, '', '', '', '', '', '', '', '', 1, '2020-05-27 09:23:09', '2020-06-10 07:16:19', '', 0),
(30, 1, NULL, 1590564666, '', 'Diploma', '0', '', 5, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-05-27 09:23:09', '2020-06-10 07:16:19', '', 0),
(51, 1, NULL, 1594629436, 'SSVM', 'High School (10)', '2005', '68767867', 1, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-07-13 08:46:31', '2020-07-13 09:13:13', 'ghghghg', 2),
(52, 1, NULL, 1594629436, 'SSVMS', 'Intermediate (10+2)', '2007', '65765657567', 2, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-07-13 08:46:31', '2020-07-13 09:13:13', 'ddddd', 1),
(53, 1, NULL, 1594629436, '', 'Graduation', '', '', 3, '', '', '', '', '', '', '', '', 1, '2020-07-13 08:46:31', '2020-07-13 09:13:13', '', 0),
(54, 1, NULL, 1594629436, '', 'Post Graduation', '', '', 4, '', '', '', '', '', '', '', '', 1, '2020-07-13 08:46:31', '2020-07-13 09:13:13', '', 0),
(55, 1, NULL, 1594629436, '', 'Diploma', '', '', 5, '', '', '', '', '', '', '', '', 1, '2020-07-13 08:46:31', '2020-07-13 09:13:13', '', 0),
(56, 1, NULL, 1594969049, 'SSVM', 'High School (10)', '2005', '76786786', 1, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-07-17 10:20:46', '2020-07-17 10:20:46', NULL, 0),
(57, 1, NULL, 1594969049, '', 'Intermediate (10+2)', '', '', 2, '', '', '', '', '', '', '', '', 1, '2020-07-17 10:20:46', '2020-07-17 10:20:46', NULL, 0),
(58, 1, NULL, 1594969049, '', 'Graduation', '', '', 3, '', '', '', '', '', '', '', '', 1, '2020-07-17 10:20:46', '2020-07-17 10:20:46', NULL, 0),
(59, 1, NULL, 1594969049, '', 'Post Graduation', '', '', 4, '', '', '', '', '', '', '', '', 1, '2020-07-17 10:20:46', '2020-07-17 10:20:46', NULL, 0),
(60, 1, NULL, 1594969049, '', 'Diploma', '', '', 5, '', '', '', '', '', '', '', '', 1, '2020-07-17 10:20:46', '2020-07-17 10:20:46', NULL, 0),
(61, 1, NULL, 1595036189, 'SSVM', 'High School (10)', '6565', '767798798', 1, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-07-18 01:43:24', '2020-07-18 01:43:24', NULL, 0),
(62, 1, NULL, 1595036189, '', 'Intermediate (10+2)', '', '', 2, '', '', '', '', '', '', '', '', 1, '2020-07-18 01:43:24', '2020-07-18 01:43:24', NULL, 0),
(63, 1, NULL, 1595036189, '', 'Graduation', '', '', 3, '', '', '', '', '', '', '', '', 1, '2020-07-18 01:43:24', '2020-07-18 01:43:24', NULL, 0),
(64, 1, NULL, 1595036189, '', 'Post Graduation', '', '', 4, '', '', '', '', '', '', '', '', 1, '2020-07-18 01:43:24', '2020-07-18 01:43:24', NULL, 0),
(65, 1, NULL, 1595036189, '', 'Diploma', '', '', 5, '', '', '', '', '', '', '', '', 1, '2020-07-18 01:43:24', '2020-07-18 01:43:24', NULL, 0),
(66, 1, NULL, 1595038588, 'iuioi', 'High School (10)', '6767', '798789787', 1, 'hghjghj', '', '', '', '', '', '', '', 1, '2020-07-18 02:23:15', '2020-07-18 02:23:15', NULL, 0),
(67, 1, NULL, 1595038588, '', 'Intermediate (10+2)', '', '', 2, '', '', '', '', '', '', '', '', 1, '2020-07-18 02:23:15', '2020-07-18 02:23:15', NULL, 0),
(68, 1, NULL, 1595038588, '', 'Graduation', '', '', 3, '', '', '', '', '', '', '', '', 1, '2020-07-18 02:23:15', '2020-07-18 02:23:15', NULL, 0),
(69, 1, NULL, 1595038588, '', 'Post Graduation', '', '', 4, '', '', '', '', '', '', '', '', 1, '2020-07-18 02:23:15', '2020-07-18 02:23:15', NULL, 0),
(70, 1, NULL, 1595038588, '', 'Diploma', '', '', 5, '', '', '', '', '', '', '', '', 1, '2020-07-18 02:23:15', '2020-07-18 02:23:15', NULL, 0),
(71, 1, NULL, 1595039995, 'SSVM', 'High School (10)', '7667', '788788979', 1, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-07-18 02:48:46', '2020-07-18 02:48:46', NULL, 0),
(72, 1, NULL, 1595039995, '', 'Intermediate (10+2)', '', '', 2, '', '', '', '', '', '', '', '', 1, '2020-07-18 02:48:46', '2020-07-18 02:48:46', NULL, 0),
(73, 1, NULL, 1595039995, '', 'Graduation', '', '', 3, '', '', '', '', '', '', '', '', 1, '2020-07-18 02:48:46', '2020-07-18 02:48:46', NULL, 0),
(74, 1, NULL, 1595039995, '', 'Post Graduation', '', '', 4, '', '', '', '', '', '', '', '', 1, '2020-07-18 02:48:46', '2020-07-18 02:48:46', NULL, 0),
(75, 1, NULL, 1595039995, '', 'Diploma', '', '', 5, '', '', '', '', '', '', '', '', 1, '2020-07-18 02:48:46', '2020-07-18 02:48:46', NULL, 0),
(76, 1, NULL, 1595056660, 'SSVM', 'High School (10)', '7677', '767876876', 1, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-07-18 07:25:26', '2020-07-20 04:12:41', 'dfgdfgdg', 1),
(77, 1, NULL, 1595056660, 'SSVMS', 'Intermediate (10+2)', '8878', '778978989', 2, 'UP BOARD', '', '', '', '', '', '', '', 1, '2020-07-18 07:25:26', '2020-07-20 04:12:41', '', 0),
(78, 1, NULL, 1595056660, '', 'Graduation', '', '', 3, '', '', '', '', '', '', '', '', 1, '2020-07-18 07:25:26', '2020-07-20 04:12:41', '', 0),
(79, 1, NULL, 1595056660, '', 'Post Graduation', '', '', 4, '', '', '', '', '', '', '', '', 1, '2020-07-18 07:25:26', '2020-07-20 04:12:41', '', 0),
(80, 1, NULL, 1595056660, '', 'Diploma', '', '', 5, '', '', '', '', '', '', '', '', 1, '2020-07-18 07:25:26', '2020-07-20 04:12:41', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_education_tbl_check`
--

CREATE TABLE `employee_education_tbl_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `employee_education_tbl_id` int(11) NOT NULL,
  `is_emp_name_correct` varchar(20) NOT NULL,
  `is_rollno_correct` varchar(30) NOT NULL,
  `is_university_correct` varchar(30) NOT NULL,
  `is_institute_correct` varchar(30) NOT NULL,
  `is_passing_year_correct` varchar(30) NOT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remark` text DEFAULT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_education_tbl_check`
--

INSERT INTO `employee_education_tbl_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `employee_education_tbl_id`, `is_emp_name_correct`, `is_rollno_correct`, `is_university_correct`, `is_institute_correct`, `is_passing_year_correct`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(11, 1, NULL, 1590564666, 'dfgdfg', 1, 26, '', '2', '1', '', '1', '', 'fdggfhfghfg', 'gghgf', 'ghghgfh', 0, 1, '2020-05-31 03:39:22', '2020-06-26 12:40:47'),
(12, 1, NULL, 1590564666, '', 2, 27, '', '2', '1', '', '2', '', 'dghfg', 'gfhfh', 'gfhgfhf', 0, 1, '2020-05-31 03:39:22', '2020-06-26 12:40:47'),
(13, 1, NULL, 1590564666, '', 0, 28, '', '', '', '1', '1', '', '', '', '', 0, 1, '2020-05-31 03:39:22', '2020-06-26 12:40:47'),
(14, 1, NULL, 1590564666, '', 0, 29, '', '', '', '', '', '', '', '', '', 0, 1, '2020-05-31 03:39:22', '2020-06-26 12:40:47'),
(15, 1, NULL, 1590564666, '', 0, 30, '', '', '', '', '', '', '', '', '', 0, 1, '2020-05-31 03:39:22', '2020-06-26 12:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `employee_employment_info_tbl`
--

CREATE TABLE `employee_employment_info_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `employee_code` varchar(50) NOT NULL,
  `company_name` varchar(128) DEFAULT NULL,
  `employer_name` varchar(128) DEFAULT NULL,
  `reporting_mngr_name` varchar(128) DEFAULT NULL,
  `reporting_mngr_email` varchar(128) DEFAULT NULL,
  `designation` varchar(120) NOT NULL,
  `department` varchar(50) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `branch_address` text NOT NULL,
  `company_phone` varchar(128) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(15) NOT NULL,
  `landmark` varchar(70) NOT NULL,
  `country` varchar(50) NOT NULL,
  `order_no` int(11) NOT NULL,
  `behavior` varchar(150) NOT NULL,
  `date_of_joining` varchar(50) NOT NULL,
  `date_of_relieving` varchar(50) NOT NULL,
  `reason_for_leaving` text DEFAULT NULL,
  `attached_document_are_genuine_or_not` int(11) NOT NULL DEFAULT 0,
  `attached_document` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0 COMMENT '0=In-Completed,\r\n1=Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_employment_info_tbl`
--

INSERT INTO `employee_employment_info_tbl` (`id`, `user_id`, `client_id`, `application_id`, `employee_code`, `company_name`, `employer_name`, `reporting_mngr_name`, `reporting_mngr_email`, `designation`, `department`, `salary`, `branch_address`, `company_phone`, `city`, `state`, `pincode`, `landmark`, `country`, `order_no`, `behavior`, `date_of_joining`, `date_of_relieving`, `reason_for_leaving`, `attached_document_are_genuine_or_not`, `attached_document`, `status`, `created_at`, `updated_at`, `review_comment`, `is_completed`) VALUES
(38, 1, NULL, 1590564666, '', 'Lucknow', 'TATAddd', 'Rahul', 'rahul@gmail.com', 'Data Entry', 'IT', '300000', 'yryrty', '0', '', '', '', '', '', 0, '', '2020-05-13', '2020-05-29', 'hhh', 0, '', 1, '2020-05-27 08:01:53', '2020-06-08 08:34:48', '1', 2),
(39, 1, NULL, 1590564666, '', '', 'Please Enter employer name', '', '', 'Data Entry', 'IT', '', '', '0', '', '', '', '', '', 1, '', '', '', '', 0, '', 1, '2020-05-27 08:01:53', '2020-06-08 08:34:48', '2', 2),
(40, 1, NULL, 1590564666, '', '', 'Please Enter employer name', '', '', 'Data Entry', 'IT', '', '', '0', '', '', '', '', '', 2, '', '', '', '', 0, '', 1, '2020-05-27 08:01:53', '2020-06-08 08:34:48', '3', 2),
(53, 1, NULL, 1594629436, '', 'YYUTUYT', 'Akshay', 'jhjh', 'hjh@jhjh.com', 'hghg', 'ghghg', '7676', 'yuyuyu', '878878787878', '', '', '', '', '', 0, '', '2020-07-07', '2020-07-11', 'ghghg', 0, '', 1, '2020-07-13 08:48:35', '2020-07-13 09:43:12', 'eeeeeeeeeeeeee', 2),
(54, 1, NULL, 1594629436, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', 0, '', 1, '2020-07-13 08:48:35', '2020-07-13 09:16:58', '', 0),
(55, 1, NULL, 1594629436, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, '', '', '', '', 0, '', 1, '2020-07-13 08:48:35', '2020-07-13 09:16:58', '', 0),
(61, 1, NULL, 1595038588, '', 'yyuyui', 'yuiy', 'hghjghj', 'rahul@gmail.com', 'ghgg', 'hgjg', '80000', 'hjhjh', '87897897879', '', '', '', '', '', 0, '', '2020-07-11', '2020-07-25', 'ghjgjg', 0, '', 1, '2020-07-18 02:28:01', '2020-07-18 02:28:01', NULL, 0),
(62, 1, NULL, 1595038588, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', 0, '', 1, '2020-07-18 02:28:01', '2020-07-18 02:28:01', NULL, 0),
(63, 1, NULL, 1595038588, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, '', '', '', '', 0, '', 1, '2020-07-18 02:28:01', '2020-07-18 02:28:01', NULL, 0),
(64, 1, NULL, 1595039995, '', 'iyyyu', 'jhkh', 'jhhjkhj', 'hjh@jhjh.com', 'jhjjjhjkhj', 'jhjkhjk', '87787', 'HJHJKJ', '7778678767687', '', '', '', '', '', 0, '', '2020-07-11', '2020-07-25', 'jhjkhjkh', 0, '', 1, '2020-07-18 02:51:22', '2020-07-18 02:51:22', NULL, 0),
(65, 1, NULL, 1595039995, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', 0, '', 1, '2020-07-18 02:51:22', '2020-07-18 02:51:22', NULL, 0),
(66, 1, NULL, 1595039995, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, '', '', '', '', 0, '', 1, '2020-07-18 02:51:22', '2020-07-18 02:51:22', NULL, 0),
(67, 1, NULL, 1595056660, '', 'hgjhgg', 'hjkhjh', 'jhjkhjkh', 'rahul@gmail.com', 'jkhjkkh', 'kjhkjhjk', '78788', 'jhjkjh', '7787988798', '', '', '', '', '', 0, '', '2020-07-10', '2020-07-30', 'jhkjjk', 0, '', 1, '2020-07-18 07:32:21', '2020-07-20 04:12:52', 'dgdfgdgdg', 1),
(68, 1, NULL, 1595056660, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', 0, '', 1, '2020-07-18 07:32:22', '2020-07-20 04:12:52', '', 0),
(69, 1, NULL, 1595056660, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, '', '', '', '', 0, '', 1, '2020-07-18 07:32:22', '2020-07-20 04:12:52', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_employment_info_tbl_check`
--

CREATE TABLE `employee_employment_info_tbl_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `employee_employment_info_tbl_id` int(11) NOT NULL,
  `eligible_for_rehire` varchar(50) NOT NULL,
  `how_was_the_candidate_behavior_during_tenure` varchar(150) NOT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remark` text NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_employment_info_tbl_check`
--

INSERT INTO `employee_employment_info_tbl_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `employee_employment_info_tbl_id`, `eligible_for_rehire`, `how_was_the_candidate_behavior_during_tenure`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, NULL, 1590564666, 'cvggffdg', 2, 38, 'gfhfhgfh', 'gd', '', 'dfgdg', 'fggf', 'ghfg', 0, 1, '2020-06-02 04:01:41', '2020-06-26 12:41:40'),
(5, 1, NULL, 1590564666, 'fdgdfg fghgfhf fghgfh', 2, 39, '', '', '', '', '', '', 0, 1, '2020-06-02 04:01:41', '2020-06-26 12:41:40'),
(6, 1, NULL, 1590564666, 'ghgfhgfh rertre retr', 2, 40, '', '', '', '', '', '', 0, 1, '2020-06-02 04:01:41', '2020-06-26 12:41:40'),
(16, 1, NULL, 1595056660, NULL, 0, 67, 'hkjhkj', 'hjh', '', 'yuyuy', 'uyuiyi', 'yyuyiy', 0, 1, '2020-07-20 11:03:24', '2020-07-20 11:03:24'),
(17, 1, NULL, 1595056660, NULL, 0, 68, '', '', '', '', '', '', 0, 1, '2020-07-20 11:03:24', '2020-07-20 11:03:24'),
(18, 1, NULL, 1595056660, NULL, 0, 69, '', '', '', '', '', '', 0, 1, '2020-07-20 11:03:24', '2020-07-20 11:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_info_tbl`
--

CREATE TABLE `employee_personal_info_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` varchar(128) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `fatherName` varchar(128) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT 1 COMMENT '1=male, 2=female',
  `phoneNo` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `alternateContact` varchar(50) NOT NULL,
  `is_are_you_legally_eligible_for_employment_in_the_india` int(11) NOT NULL DEFAULT 1,
  `profile_image` varchar(128) NOT NULL,
  `attached_document` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0 COMMENT '0=In-Completed,\r\n1=Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_personal_info_tbl`
--

INSERT INTO `employee_personal_info_tbl` (`id`, `user_id`, `client_id`, `application_id`, `firstName`, `lastName`, `middleName`, `fatherName`, `dob`, `gender`, `phoneNo`, `email`, `alternateContact`, `is_are_you_legally_eligible_for_employment_in_the_india`, `profile_image`, `attached_document`, `status`, `created_at`, `updated_at`, `review_comment`, `is_completed`) VALUES
(43, 1, NULL, '1590564666', 'fghgf', 'gfhfg', 'vjhjhghg', 'hhhh', '2020-06-10', 1, '6756567767', 'ramji@gmail.com', '78789', 1, '', '', 1, '2020-05-27 07:39:02', '2020-06-08 08:26:09', 'yyyyyyyy', 2),
(51, 1, NULL, '1594629436', 'Victor', 'gfhgf', 'gfhfg', 'yutt', '2020-07-08', 1, '7888777777', 'ytyt@hghg.coi', '7878766666', 1, 'A59FFA37-B509-94D0-856D-9BD8220FA223.jpg', '', 1, '2020-07-13 08:40:52', '2020-07-13 09:11:31', 'bbbbbbbbbbb', 2),
(52, 1, NULL, '1594967715', 'huyuy', 'yuiyyui', 'ytytyty', 'yututu', '2020-07-10', 1, '9897878979', 'hghg@hgh.ccc', '7668686', 1, '3A083E19-6F86-DF28-11C0-57364B16EE6C.jpg', '', 1, '2020-07-17 06:50:23', '2020-07-17 06:50:23', NULL, 0),
(53, 1, NULL, '1594969049', 'uyuy', 'yuyy', 'yuyuiy', 'uyyyi', '2020-07-10', 1, '8787877977', 'ytyt@hghg.coi', '897977977', 2, '63E827B5-644B-9E2F-5455-3D9FEBFEC62C.jpg', '', 1, '2020-07-17 07:00:19', '2020-07-17 07:00:19', NULL, 0),
(54, 1, NULL, '1595036189', 'uyiuyy', 'yuyyiuy', 'yuiyiuy', 'uiyuiyi', '2020-07-22', 1, '7878978977', 'yttryt@ghjgj.ghh', '8978978787', 1, 'E536F6D9-3BAE-FDA7-B013-4382D23182E6.jpg', '', 1, '2020-07-18 01:38:09', '2020-07-18 01:38:09', NULL, 0),
(55, 1, NULL, '1595038588', 'hjhj', 'hjhjh', '67676', 'uyuiyiuy', '2020-07-10', 1, '8788787897', 'fd@hmail.com', '897797979', 2, 'D1F66459-3063-F674-9138-D25B2B03F70B.jpg', '', 1, '2020-07-18 02:19:13', '2020-07-18 02:19:13', NULL, 0),
(56, 1, NULL, '1595039995', 'yuyuyu', 'yiuyui', 'hhjhhg', 'ghjghjgj', '2020-07-17', 1, '9787978979', 'gfhfg@gfhgf.ghg', '7989878777', 1, 'CFBAD9A5-B3BC-D3A8-E4EF-2FD8A65CB6DD.jpg', '', 1, '2020-07-18 02:45:15', '2020-07-18 02:45:15', NULL, 0),
(57, 1, NULL, '1595056660', 'hjjhjk', 'hjhjk', 'gjhgjhg', 'jhghjghjg', '2020-07-17', 1, '7878789887', 'ramji@gmail.com', '7878878999', 2, '42589DC5-5BBC-065E-E882-304336498753.jpg', '', 1, '2020-07-18 07:19:13', '2020-07-20 04:12:24', 'gdfgdgd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_info_tbl_check`
--

CREATE TABLE `employee_personal_info_tbl_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `employee_personal_info_tbl_id` int(11) NOT NULL,
  `verifier_name` varchar(128) NOT NULL,
  `verifier_designation` varchar(256) NOT NULL,
  `verifier_remark` varchar(256) NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_personal_info_tbl_check`
--

INSERT INTO `employee_personal_info_tbl_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `employee_personal_info_tbl_id`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, NULL, 1590564666, 'hhhhhh', 2, 43, 'fddfg', 'dgdgd', 'dfgdgdf', 0, 0, '2020-05-31 03:38:57', '2020-05-31 03:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `employee_police_verification`
--

CREATE TABLE `employee_police_verification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `middle_name` varchar(70) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `landmark` varchar(70) NOT NULL,
  `pincode` varchar(70) NOT NULL,
  `police_station` varchar(70) NOT NULL,
  `post_office` varchar(50) NOT NULL,
  `village` varchar(128) DEFAULT NULL,
  `house_no` varchar(128) DEFAULT NULL,
  `street_no` varchar(128) DEFAULT NULL,
  `area` varchar(128) DEFAULT NULL,
  `district` varchar(128) DEFAULT NULL,
  `attached_document` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0 COMMENT '0=In-Completed,\r\n1=Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_police_verification`
--

INSERT INTO `employee_police_verification` (`id`, `user_id`, `client_id`, `application_id`, `first_name`, `last_name`, `middle_name`, `address`, `city`, `state`, `country`, `landmark`, `pincode`, `police_station`, `post_office`, `village`, `house_no`, `street_no`, `area`, `district`, `attached_document`, `status`, `created_at`, `updated_at`, `review_comment`, `is_completed`) VALUES
(4, 1, NULL, 1590564666, 'yuytu', 'HHHHHHHHHHH', 'werwer', ' HHHHHHHHHHH', '[San CristÃ³bal de] la Laguna', 'Andhra Pradesh', 'India', 'rtert', '546456', 'yry', 'ertert', 'gfhfhgf', 'werwer', '453453', 'ertr', 'Delhi', '', 1, '2020-05-27 08:44:44', '2020-06-08 08:35:38', 'not verified', 2),
(9, 1, NULL, 1594629436, 'IYY', 'ytyt', 'yyu', 'uyiuyiuy', 'Abohar', 'Andhra Pradesh', 'India', 'uyuy', '7676', 'hhjhj', 'yutt', 'yuyuy', 'yutut', 'yutyut', 'tyut', 'Kolkata', '', 1, '2020-07-13 08:49:43', '2020-07-13 09:43:37', 'ffffffffffff', 2),
(12, 1, NULL, 1595056660, 'hjhjhkj', 'hjhkj', 'jhjkhjkh', 'jhjhkjh', 'Abohar', 'Andhra Pradesh', 'India', 'jhkjhkj', '887768', 'hjtjggjhg', 'jhjkh', 'jjhk', 'jhjh', 'hjkjh', 'hjkhkh', 'Kolkata', '', 1, '2020-07-18 07:34:29', '2020-07-20 04:13:00', 'dgdgfgdfgd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_police_verification_check`
--

CREATE TABLE `employee_police_verification_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `employee_police_verification_id` int(11) NOT NULL,
  `police_authority` varchar(90) NOT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remark` text NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_police_verification_check`
--

INSERT INTO `employee_police_verification_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `employee_police_verification_id`, `police_authority`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1590564666, 'gfghfghf hgfh', 2, 4, 'tyyyrtytr', '', 'tytry', 'tryrty', 'rtyrty', 2, 1, '2020-06-02 04:02:03', '2020-06-26 12:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `employee_reference`
--

CREATE TABLE `employee_reference` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_no` varchar(128) NOT NULL,
  `email_address` varchar(30) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `organization_name` varchar(60) NOT NULL,
  `relation` varchar(50) NOT NULL,
  `address` varchar(90) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `landmark` varchar(90) NOT NULL,
  `reference_type` int(10) NOT NULL COMMENT '1=professional, 2=personal',
  `attached_document` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `order_no` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0 COMMENT '0=In-Completed,\r\n1=Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_reference`
--

INSERT INTO `employee_reference` (`id`, `user_id`, `client_id`, `application_id`, `name`, `phone_no`, `email_address`, `designation`, `organization_name`, `relation`, `address`, `city`, `state`, `country`, `pin_code`, `landmark`, `reference_type`, `attached_document`, `status`, `order_no`, `created_at`, `updated_at`, `review_comment`, `is_completed`) VALUES
(9, 1, NULL, 1590564666, 'Aakash kumar tt', '4647567', 'aakash2@gmail.com', '', '', '', 'hhhh', 'Machakos', 'Haryana', 'India', '67567', 'yyyy', 2, '', 1, 1, '2020-05-27 09:00:06', '2020-06-08 08:36:48', '11', 2),
(10, 1, NULL, 1590564666, 'Raja', '2147483647', 'raja@gmail.com', '', '', '', 'ghgghgh', '[San CristÃ³bal de] la Laguna', 'Andhra Pradesh', 'India', '454569', 'yyyyy', 2, '', 1, 2, '2020-05-27 09:00:06', '2020-06-08 08:36:48', '12', 2),
(11, 1, NULL, 1590564666, 'tyrty', '64564', '', '', '', '', 'rtyrty', '[San CristÃ³bal de] la Laguna', 'Andhra Pradesh', 'India', '', 'hfghg', 1, '', 1, 3, '2020-05-27 09:00:06', '2020-06-08 08:36:48', '21', 2),
(12, 1, NULL, 1590564666, 'rty', '676576575', 'yrt@gmail.com', '', '', '', 'fghfh', '[San CristÃ³bal de] la Laguna', 'Delhi', 'India', '6757657', 'hhhh', 1, '', 1, 4, '2020-05-27 09:00:06', '2020-06-08 08:36:48', '22', 2),
(29, 1, NULL, 1594629436, 'yytyut', '6676676', 'hjhjh@hjjh.ccc', '', '', '', 'hjgghjg', 'Abohar', 'Andhra Pradesh', 'India', '767667', 'tyyty', 2, '', 1, 1, '2020-07-13 08:50:49', '2020-07-13 09:44:12', 'ggggggg', 2),
(30, 1, NULL, 1594629436, '', '', '', '', '', '', '', '', '', '', '', '', 2, '', 1, 2, '2020-07-13 08:50:49', '2020-07-13 09:44:12', '', 0),
(31, 1, NULL, 1594629436, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', 1, 3, '2020-07-13 08:50:49', '2020-07-13 09:44:12', '', 0),
(32, 1, NULL, 1594629436, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', 1, 4, '2020-07-13 08:50:49', '2020-07-13 09:44:12', '', 0),
(33, 1, NULL, 1595056660, 'jjkj', '87779889877', 'rajvraj@gmail.com', '', '', '', 'ytyggjh', 'Abohar', 'Andhra Pradesh', 'India', '878798', 'hhghgjg', 2, '', 1, 1, '2020-07-18 07:37:32', '2020-07-20 04:13:08', 'tyrtyryry', 1),
(34, 1, NULL, 1595056660, '', '', '', '', '', '', '', '', '', '', '', '', 2, '', 1, 2, '2020-07-18 07:37:32', '2020-07-20 04:13:08', '', 0),
(35, 1, NULL, 1595056660, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', 1, 3, '2020-07-18 07:37:32', '2020-07-20 04:13:08', '', 0),
(36, 1, NULL, 1595056660, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', 1, 4, '2020-07-18 07:37:32', '2020-07-20 04:13:08', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_reference_check`
--

CREATE TABLE `employee_reference_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `employee_reference_id` int(11) NOT NULL,
  `about_candidate_during_period` varchar(100) NOT NULL,
  `about_association_period` varchar(100) NOT NULL,
  `self_improvement` varchar(100) NOT NULL,
  `general_reputation` varchar(100) NOT NULL,
  `ratings` int(11) NOT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remark` text NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_reference_check`
--

INSERT INTO `employee_reference_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `employee_reference_id`, `about_candidate_during_period`, `about_association_period`, `self_improvement`, `general_reputation`, `ratings`, `attached_document`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1590564666, 'gfhgfhf', 1, 9, 'hgf', 'ghg', 'fghgfhfh', 'fghfgh', 1, '', 'rttert', 'trertre', 'uyuiu', 0, 1, '2020-06-02 04:02:29', '2020-06-26 12:41:57'),
(2, 1, NULL, 1590564666, '', 0, 10, '', '', '', '', 1, '', '', '', '', 0, 1, '2020-06-02 04:02:29', '2020-06-26 12:41:57'),
(3, 1, NULL, 1590564666, '', 0, 11, '', '', '', '', 1, '', '', '', '', 0, 1, '2020-06-02 04:02:29', '2020-06-26 12:41:57'),
(4, 1, NULL, 1590564666, '', 0, 12, '', '', '', '', 1, '', '', '', '', 0, 1, '2020-06-02 04:02:29', '2020-06-26 12:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `employer_feedback`
--

CREATE TABLE `employer_feedback` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `feedback` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_access_client` int(11) DEFAULT NULL,
  `password_client` int(11) DEFAULT NULL,
  `revoked` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vikas', 'nFOKVNn2eY8gltLbqSgspkkoziEquScWZYGPZvZu', 'http://localhost', 1, 0, 0, '2018-12-30 20:07:04', '2018-12-30 20:07:04'),
(2, NULL, 'Laravel Personal Access Client', 'DvaLx2cl9Etf6VBfTvKbFoCtv3clMRx6yVZtlMVD', 'http://localhost', 1, 0, 0, '2018-12-30 15:53:50', '2018-12-30 15:53:50'),
(3, NULL, 'Laravel Personal Access Client', 'KRZ6l5C1bYOoKqIck8ie2hwgiWSs1m9o41PxCJrZ', 'http://localhost', 1, 0, 0, '2018-12-30 15:54:05', '2018-12-30 15:54:05'),
(4, NULL, 'Laravel Personal Access Client', 'zw9F2z2O1JNLs5tJgIrfDTZL2lUnlezyH7iFZPpz', 'http://localhost', 1, 0, 0, '2018-12-30 15:57:46', '2018-12-30 15:57:46'),
(5, NULL, 'Laravel Password Grant Client', 'Pa40xkBEXGNswSub1FJSA4HSzdGSTCPluM6XutoK', 'http://localhost', 0, 1, 0, '2018-12-30 15:57:46', '2018-12-30 15:57:46'),
(6, NULL, 'Laravel Personal Access Client', 'eY1WMoxU2gmlBHmY7PgbpRRIx4xJ7rj4stHNQcE1', 'http://localhost', 1, 0, 0, '2018-12-30 15:58:16', '2018-12-30 15:58:16'),
(7, NULL, 'Laravel Password Grant Client', '0C7g5TFNiCJD2N8hLwqxvIPsEL9h4Zh8ons7wDyR', 'http://localhost', 0, 1, 0, '2018-12-30 15:58:16', '2018-12-30 15:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`client_id`, `created_at`, `updated_at`) VALUES
(2, '2018-12-30 21:27:29', '2018-12-30 21:27:29'),
(3, '2018-12-30 21:27:29', '2018-12-30 21:27:29'),
(4, '2018-12-30 15:57:46', '2018-12-30 15:57:46'),
(6, '2018-12-30 15:58:16', '2018-12-30 15:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region` varchar(50) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `region`, `created_on`) VALUES
(1, 'EAST', '2018-10-24 05:42:19'),
(2, 'WEST', '2018-10-24 05:42:19'),
(3, 'NORTH', '2018-10-24 05:42:29'),
(4, 'SOUTH', '2018-10-24 05:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `sms_notifications`
--

CREATE TABLE `sms_notifications` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`, `country_id`) VALUES
(732, 'Andhra Pradesh', 100),
(733, 'Assam', 100),
(734, 'Bihar', 100),
(735, 'Chandigarh', 100),
(736, 'Chhatisgarh', 100),
(737, 'Delhi', 100),
(738, 'Gujarat', 100),
(739, 'Haryana', 100),
(740, 'Jammu and Kashmir', 100),
(741, 'Jharkhand', 100),
(742, 'Karnataka', 100),
(743, 'Kerala', 100),
(744, 'Madhya Pradesh', 100),
(745, 'Maharashtra', 100),
(746, 'Manipur', 100),
(747, 'Meghalaya', 100),
(748, 'Mizoram', 100),
(749, 'Orissa', 100),
(750, 'Pondicherry', 100),
(751, 'Punjab', 100),
(752, 'Rajasthan', 100),
(753, 'Tamil Nadu', 100),
(754, 'Tripura', 100),
(755, 'Uttar Pradesh', 100),
(756, 'Uttaranchal', 100),
(757, 'West Bengal', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application`
--

CREATE TABLE `tbl_application` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `hmds_id` varchar(50) NOT NULL,
  `application_ref_id` varchar(40) NOT NULL,
  `unique_id` varchar(30) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_contact_number` varchar(20) NOT NULL,
  `client_relationship_person_name` varchar(50) NOT NULL,
  `client_location` varchar(90) NOT NULL,
  `client_address` varchar(130) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `landmark` varchar(90) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `website` varchar(50) NOT NULL,
  `fax_number` varchar(25) NOT NULL,
  `attachment_image` text NOT NULL,
  `case_id` varchar(30) NOT NULL,
  `case_record_date` varchar(128) NOT NULL,
  `type_of_check` varchar(50) NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=under review,\r\n2=under verification,\r\n3=verification complete,\r\n4=form data error, \r\n5= Generated Verification report\r\n6=Pending Finance Approval\r\n7=Insuff raised',
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) NOT NULL DEFAULT 0 COMMENT '0=NA,\r\n1=Completed,\r\n2=Incomplete',
  `verification_mode` varchar(128) DEFAULT NULL COMMENT 'verbally\r\nwritten\r\nboth',
  `client_ref_number` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_application`
--

INSERT INTO `tbl_application` (`id`, `user_id`, `client_id`, `hmds_id`, `application_ref_id`, `unique_id`, `client_name`, `client_contact_number`, `client_relationship_person_name`, `client_location`, `client_address`, `city`, `state`, `country`, `landmark`, `pincode`, `email`, `phone`, `website`, `fax_number`, `attachment_image`, `case_id`, `case_record_date`, `type_of_check`, `application_status`, `review_comment`, `is_completed`, `verification_mode`, `client_ref_number`) VALUES
(14, 1, NULL, 'HMDS-1590564666', '1590564666', '76877868767', '4630MS', '7878768768', 'Brother', 'ghhg', '', '', '', '', '', '', '', '', '', '', '', 'case-1', '2020-05-20', '1,2,3,4,5,6,7,8,9,10,11,12,13,14', 2, 'jgjgjgg', 1, 'verbally', '7565756756'),
(63, 1, NULL, 'HMDS-1594629436', '1594629436', '5654645', '4790', '5646455555', 'hjhjh', 'Lucknow', '', '', '', '', '', '', '', '', '', '', '', '455435435', '2020-07-08', '1,2,3,4,5,6,7', 4, 'aaaaaaaaa', 2, 'written', '45435434345'),
(64, 1, NULL, 'HMDS-1594967715', '1594967715', '78787', '4630SM', '7678678687', 'fhhgh', 'Noida', '', '', '', '', '', '', '', '', '', '', '', '67676GFG', '2020-07-09', '1,2,3,4,5', 1, NULL, 0, 'written', '878787'),
(65, 1, NULL, 'HMDS-1594969049', '1594969049', '56565HJJH', '4460', '7867676787', 'yuyy', 'Noida', '', '', '', '', '', '', '', '', '', '', '', 'HHGHG8787', '2020-07-10', '1,2,3,4', 1, NULL, 0, 'verbally', '876687678'),
(66, 1, NULL, 'HMDS-1595036189', '1595036189', '76786', '4460', '6767678676', 'Hhjkh', 'yiuiy', '', '', '', '', '', '', '', '', '', '', '', '778977', '2020-07-11', '1,2,3,4,5,6', 1, NULL, 0, 'written', '6876786'),
(67, 1, NULL, 'HMDS-1595038588', '1595038588', '767886', '4630SM', '7666686876', 'yyyy', 'jhjhj', '', '', '', '', '', '', '', '', '', '', '', '767867678', '2020-07-10', '1,2,3,4,5,6', 1, NULL, 0, 'written', '776687'),
(68, 1, NULL, 'HMDS-1595039995', '1595039995', '78977', '4630MS', '7897897777', 'jkhjkhjkh', 'hjhjh jhh', '', '', '', '', '', '', '', '', '', '', '', '676666876786', '2020-07-10', '1,2,3,4,5,6', 1, NULL, 0, 'written', '7897979877'),
(69, 1, NULL, 'HMDS-1595056660', '1595056660', '87787', '4650', '7897877778', 'uuuyuy', 'yyiuyui', '', '', '', '', '', '', '', '', '', '', '', '7897897', '2020-07-10', '1,2,3,4', 2, 'dfgdgd', 1, 'written', '88777');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application_check`
--

CREATE TABLE `tbl_application_check` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `review_comment` text DEFAULT NULL,
  `is_completed` int(11) DEFAULT 0,
  `verifier_name` varchar(150) DEFAULT NULL,
  `verifier_designation` varchar(150) DEFAULT NULL,
  `verifier_remark` varchar(150) DEFAULT NULL,
  `is_verify` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `complete_status_check` int(11) NOT NULL DEFAULT 0,
  `is_personal_details_checked` int(11) NOT NULL DEFAULT 0,
  `is_address_details_checked` int(11) NOT NULL DEFAULT 0,
  `is_education_details_checked` int(11) NOT NULL DEFAULT 0,
  `is_emp_details_checked` int(11) NOT NULL DEFAULT 0,
  `is_police_verification_checked` int(11) NOT NULL DEFAULT 0,
  `is_relation_details_checked` int(11) NOT NULL DEFAULT 0,
  `is_bank_details_checked` int(11) NOT NULL DEFAULT 0,
  `is_cibil_details_checked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_application_check`
--

INSERT INTO `tbl_application_check` (`id`, `user_id`, `client_id`, `application_id`, `review_comment`, `is_completed`, `verifier_name`, `verifier_designation`, `verifier_remark`, `is_verify`, `status`, `created_at`, `updated_at`, `complete_status_check`, `is_personal_details_checked`, `is_address_details_checked`, `is_education_details_checked`, `is_emp_details_checked`, `is_police_verification_checked`, `is_relation_details_checked`, `is_bank_details_checked`, `is_cibil_details_checked`) VALUES
(5, 1, NULL, 1590564666, 'dgfdgdf', 1, 'fhfghfh', 'ghhghgj', 'gjhghjg', 0, 1, '2020-05-31 03:38:11', '2020-07-20 08:24:38', 0, 2, 1, 0, 2, 1, 0, 0, 0),
(9, 1, NULL, 1595056660, 'tyrtyrtyr', 1, 'yiuyiyi', 'yiuyiuy', 'yiuyiuy', 2, 1, '2020-07-20 04:49:27', '2020-07-20 08:18:36', 0, 1, 2, 0, 2, 1, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disclaimer_content_master`
--

CREATE TABLE `tbl_disclaimer_content_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `body` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `type` varchar(150) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `read_status` enum('0','1') NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `object_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` bigint(20) NOT NULL DEFAULT 1,
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text',
  `description` text NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`, `description`, `priority`) VALUES
(1, 'System Administrator', '', 1),
(2, 'Admin IT', '', 2),
(3, 'Director', '', 3),
(4, 'Manager', 'Case seperation by Team', 4),
(5, 'Manager', 'Insuff raised first level to Client', 5),
(6, 'Manager', 'Case allocation to team', 6),
(7, 'Manager', 'Insuff raised second level to Client', 7),
(8, 'Manager', 'Cost approval request to client', 8),
(9, 'Manager', 'Approved cost send to account(notification)', 9),
(10, 'Manager', 'Quality check of final report', 10),
(11, 'Manager', 'Final report dispatch to client', 11),
(12, 'Team Leader', 'Case seperation by Team', 12),
(13, 'Team Leader', 'Insuff raised first level to Manager', 13),
(14, 'Team Leader', 'Case allocation to team/vendor/FE', 14),
(15, 'Team Leader', 'Vendor/FE upload the report ', 15),
(16, 'Team Leader', 'Quality check of revert', 16),
(17, 'Research Executive', 'Working on inventory (Open)', 17),
(18, 'Research Executive', 'Revert updation (Inhouse)', 18),
(19, 'Research Executive', 'Revert upload', 19),
(20, 'Research Executive', 'Quality check of revert', 20),
(21, 'Research Executive', 'Additional cost request from team to manager', 21),
(22, 'Postal Executive', 'Letter dispatch to concern Authority', 22),
(23, 'Postal Executive', 'POD updation/Letter dilivery Status', 23),
(24, 'Postal Executive', 'Letter recicved from Concern Authority updation', 24),
(25, 'Postal Executive', 'Revert updation (Post)', 25),
(26, 'Quality check team', 'Quality check First level', 26),
(27, 'Finance Team', 'DD Prepration and submission by account, DD Management', 27),
(28, 'Associate Partner', '', 28),
(29, 'Vendor', '', 29);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social_media_master`
--

CREATE TABLE `tbl_social_media_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `social_media_title` longtext NOT NULL,
  `social_media_link` longtext NOT NULL,
  `upload_icon_for_social_media` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_check`
--

CREATE TABLE `type_of_check` (
  `id` int(11) NOT NULL,
  `checkType` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkType_descriptions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_of_check`
--

INSERT INTO `type_of_check` (`id`, `checkType`, `checkType_descriptions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Address Verification', '', 1, '2020-04-13 08:21:11', '2020-05-28 16:17:59'),
(2, 'Company Verification', '', 1, '2020-04-13 08:21:11', '2020-05-28 16:18:35'),
(3, 'Document Verification (KYC)', '', 1, '2020-04-13 08:21:11', '2020-05-28 16:18:16'),
(4, 'Education Verification', '', 1, '2020-04-13 08:21:11', '2020-05-28 16:18:39'),
(5, 'Identity Verification', '', 1, '2020-04-13 08:28:45', '2020-05-28 16:18:57'),
(6, 'Police Verification', '', 1, '2020-04-13 08:28:45', '2020-05-28 16:19:06'),
(7, 'Professional Reference Verification', '', 1, '2020-04-13 08:21:11', '2020-05-28 16:17:59'),
(8, 'Previous Employment Verification', '', 1, '2020-04-13 08:21:11', '2020-05-28 16:18:35'),
(9, 'Bank Statement Verification', '', 1, '2020-04-13 08:21:11', '2020-05-28 16:18:16'),
(10, 'CIBIL Check', '', 1, '2020-04-13 08:21:11', '2020-05-28 16:18:39'),
(11, 'Court Records Check', '', 1, '2020-04-13 08:28:45', '2020-05-28 16:18:57'),
(12, 'Drug Test Screening', '', 1, '2020-04-13 08:28:45', '2020-05-28 16:19:06'),
(13, 'Medical Health Test', '', 1, '2020-04-13 08:28:45', '2020-05-28 16:18:57'),
(14, 'Psychometric Test', '', 1, '2020-04-13 08:28:45', '2020-05-28 16:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT 0,
  `contact` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `avatar` varchar(128) NOT NULL,
  `salt` text DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `client_id` int(11) NOT NULL,
  `is_login` int(11) NOT NULL DEFAULT 0,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `department`, `role`, `contact`, `email`, `avatar`, `salt`, `active`, `client_id`, `is_login`, `login_time`) VALUES
(1, 'super_admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Super Admin', 1, '', '', '', '', 1, 0, 1, '2020-07-20 03:53:27'),
(52, 'test1', 'e10adc3949ba59abbe56e057f20f883e', 'Umesh', 'Admin IT', 2, '234232', 'weqe@sfsd.com', '1586744685-images (1).jpg', NULL, 1, 16, 1, '2020-04-18 18:46:03'),
(53, 'vickie', 'e10adc3949ba59abbe56e057f20f883e', 'Vickie', 'Associate Partner', 28, '45345353', 'gasj@fdasj.com', '1586762106-images (1).jpg', NULL, 1, 11, 0, '2020-04-13 07:15:45'),
(54, 'VVVVV', 'b59c67bf196a4758191e42f76670ceba', 'Vikas Singh', 'Admin IT', 2, '9643567884', 'rachnachauhan9110@gmail.com', '1587233273-images (1).jpg', NULL, 1, 10, 0, '2020-04-18 18:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `verifier_identity`
--

CREATE TABLE `verifier_identity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `verifier_identity_id` varchar(50) NOT NULL,
  `document_type` varchar(50) NOT NULL,
  `verifier_authority` varchar(70) NOT NULL,
  `attached_document` text NOT NULL,
  `verifier_name` varchar(50) DEFAULT NULL,
  `verifier_designation` varchar(50) DEFAULT NULL,
  `verifier_remarks` text NOT NULL,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us_content_master`
--
ALTER TABLE `about_us_content_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `background_check_list_master`
--
ALTER TABLE `background_check_list_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_statement_info`
--
ALTER TABLE `bank_statement_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_statement_info_check`
--
ALTER TABLE `bank_statement_info_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `corporate_mater`
--
ALTER TABLE `corporate_mater`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_name` (`customer_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_upload`
--
ALTER TABLE `document_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drug_abuse_test_check`
--
ALTER TABLE `drug_abuse_test_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_notifications`
--
ALTER TABLE `email_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_address`
--
ALTER TABLE `employee_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_address_check`
--
ALTER TABLE `employee_address_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_cibil_check`
--
ALTER TABLE `employee_cibil_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_cibil_info`
--
ALTER TABLE `employee_cibil_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_court_record_check`
--
ALTER TABLE `employee_court_record_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_education_tbl`
--
ALTER TABLE `employee_education_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_education_tbl_check`
--
ALTER TABLE `employee_education_tbl_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_employment_info_tbl`
--
ALTER TABLE `employee_employment_info_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_employment_info_tbl_check`
--
ALTER TABLE `employee_employment_info_tbl_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_personal_info_tbl`
--
ALTER TABLE `employee_personal_info_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_personal_info_tbl_check`
--
ALTER TABLE `employee_personal_info_tbl_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_police_verification`
--
ALTER TABLE `employee_police_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_police_verification_check`
--
ALTER TABLE `employee_police_verification_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_reference`
--
ALTER TABLE `employee_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_reference_check`
--
ALTER TABLE `employee_reference_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_feedback`
--
ALTER TABLE `employer_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_notifications`
--
ALTER TABLE `sms_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_application`
--
ALTER TABLE `tbl_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_application_check`
--
ALTER TABLE `tbl_application_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_disclaimer_content_master`
--
ALTER TABLE `tbl_disclaimer_content_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_social_media_master`
--
ALTER TABLE `tbl_social_media_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_check`
--
ALTER TABLE `type_of_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifier_identity`
--
ALTER TABLE `verifier_identity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us_content_master`
--
ALTER TABLE `about_us_content_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `background_check_list_master`
--
ALTER TABLE `background_check_list_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_statement_info`
--
ALTER TABLE `bank_statement_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bank_statement_info_check`
--
ALTER TABLE `bank_statement_info_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6178;

--
-- AUTO_INCREMENT for table `corporate_mater`
--
ALTER TABLE `corporate_mater`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_upload`
--
ALTER TABLE `document_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `drug_abuse_test_check`
--
ALTER TABLE `drug_abuse_test_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_notifications`
--
ALTER TABLE `email_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_address`
--
ALTER TABLE `employee_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `employee_address_check`
--
ALTER TABLE `employee_address_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employee_cibil_check`
--
ALTER TABLE `employee_cibil_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_cibil_info`
--
ALTER TABLE `employee_cibil_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_court_record_check`
--
ALTER TABLE `employee_court_record_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_education_tbl`
--
ALTER TABLE `employee_education_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `employee_education_tbl_check`
--
ALTER TABLE `employee_education_tbl_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `employee_employment_info_tbl`
--
ALTER TABLE `employee_employment_info_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `employee_employment_info_tbl_check`
--
ALTER TABLE `employee_employment_info_tbl_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employee_personal_info_tbl`
--
ALTER TABLE `employee_personal_info_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `employee_personal_info_tbl_check`
--
ALTER TABLE `employee_personal_info_tbl_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_police_verification`
--
ALTER TABLE `employee_police_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_police_verification_check`
--
ALTER TABLE `employee_police_verification_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_reference`
--
ALTER TABLE `employee_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `employee_reference_check`
--
ALTER TABLE `employee_reference_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employer_feedback`
--
ALTER TABLE `employer_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_notifications`
--
ALTER TABLE `sms_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_application`
--
ALTER TABLE `tbl_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_application_check`
--
ALTER TABLE `tbl_application_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_disclaimer_content_master`
--
ALTER TABLE `tbl_disclaimer_content_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_social_media_master`
--
ALTER TABLE `tbl_social_media_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_of_check`
--
ALTER TABLE `type_of_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `verifier_identity`
--
ALTER TABLE `verifier_identity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

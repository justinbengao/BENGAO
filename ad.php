<?php
// Get the selected section from form submission, default to 'intro'
$current_section = isset($_POST['section']) ? $_POST['section'] : 'intro';

echo "<style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { color: purple; }
        .buttons { margin-bottom: 20px; }
        button { 
            margin: 5px; 
            padding: 15px 25px; 
            cursor: pointer;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
        }
        button:hover { background-color: teal; }
        button.active {
            background-color: teal;
            font-weight: bold;
        }
        .content { 
            margin-top: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
        }
      </style>";

$sections = [
    'intro' => [
        'title' => 'Introduce Yourself',
        'content' => function() {
            // Get form data with defaults
            $name = isset($_POST['intro_name']) ? htmlspecialchars($_POST['intro_name']) : "Justin";
            $age = isset($_POST['intro_age']) ? htmlspecialchars($_POST['intro_age']) : 23;
            $favorite_color = isset($_POST['intro_color']) ? htmlspecialchars($_POST['intro_color']) : "Beige";
            
            // Display current information
            echo "Hi, I'm $name, I am $age years old, and my favorite color is $favorite_color.<br><br>";
            
            // Edit form
            echo '<form method="POST" style="background-color: #fff; padding: 15px; border-radius: 5px; border: 1px solid #ddd;">';
            echo '<h3 style="margin-top: 0;">Edit Your Information</h3>';
            echo '<div style="margin-bottom: 10px;">';
            echo '<label style="display: block; margin-bottom: 5px; font-weight: bold;">Name:</label>';
            echo '<input type="text" name="intro_name" value="' . $name . '" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>';
            echo '</div>';
            echo '<div style="margin-bottom: 10px;">';
            echo '<label style="display: block; margin-bottom: 5px; font-weight: bold;">Age:</label>';
            echo '<input type="number" name="intro_age" value="' . $age . '" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>';
            echo '</div>';
            echo '<div style="margin-bottom: 10px;">';
            echo '<label style="display: block; margin-bottom: 5px; font-weight: bold;">Favorite Color:</label>';
            echo '<input type="text" name="intro_color" value="' . $favorite_color . '" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>';
            echo '</div>';
            echo '<input type="hidden" name="section" value="intro">';
            echo '<button type="submit" style="padding: 10px 20px; background-color: green; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">Update Information</button>';
            echo '</form>';
        }
    ],
    'math' => [
        'title' => 'Simple Math',
        'content' => function() {
            $a = isset($_POST['math_a']) ? intval($_POST['math_a']) : 10;
            $b = isset($_POST['math_b']) ? intval($_POST['math_b']) : 5;
            
            echo "Given numbers: a = $a, b = $b<br>";
            echo "Sum: " . ($a + $b) . "<br>";
            echo "Difference: " . ($a - $b) . "<br>";
            echo "Product: " . ($a * $b) . "<br>";
            echo "Quotient: " . number_format($a / $b, 2) . "<br><br>";
            
            echo '<form method="POST" class="edit-form">';
            echo '<h3 style="margin-top: 0;">Edit Numbers</h3>';
            echo '<div class="form-group">';
            echo '<label>Number A:</label>';
            echo '<input type="number" name="math_a" value="' . $a . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>Number B:</label>';
            echo '<input type="number" name="math_b" value="' . $b . '" required>';
            echo '</div>';
            echo '<input type="hidden" name="section" value="math">';
            echo '<button type="submit" class="submit-btn">Calculate</button>';
            echo '</form>';
        }
    ],
    'rectangle' => [
        'title' => 'Area and Perimeter of a Rectangle',
        'content' => function() {
            $length = isset($_POST['rect_length']) ? floatval($_POST['rect_length']) : 10;
            $width = isset($_POST['rect_width']) ? floatval($_POST['rect_width']) : 5;
            $area = $length * $width;
            $perimeter = 2 * ($length + $width);
            
            echo "For a rectangle with length = $length and width = $width:<br>";
            echo "Area = $area square units<br>";
            echo "Perimeter = $perimeter units<br><br>";
            
            echo '<form method="POST" class="edit-form">';
            echo '<h3 style="margin-top: 0;">Edit Rectangle Dimensions</h3>';
            echo '<div class="form-group">';
            echo '<label>Length:</label>';
            echo '<input type="number" step="0.01" name="rect_length" value="' . $length . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>Width:</label>';
            echo '<input type="number" step="0.01" name="rect_width" value="' . $width . '" required>';
            echo '</div>';
            echo '<input type="hidden" name="section" value="rectangle">';
            echo '<button type="submit" class="submit-btn">Calculate</button>';
            echo '</form>';
        }
    ],
    'temperature' => [
        'title' => 'Temperature Converter',
        'content' => function() {
            $celsius = isset($_POST['temp_celsius']) ? floatval($_POST['temp_celsius']) : 25;
            $fahrenheit = ($celsius * 9/5) + 32;
            
            echo $celsius . "°C is equal to " . number_format($fahrenheit, 1) . "°F.<br>";
            $celsius_check = ($fahrenheit - 32) * 5/9;
            echo "Converting back: " . number_format($fahrenheit, 1) . "°F = " . number_format($celsius_check, 1) . "°C<br><br>";
            
            echo '<form method="POST" class="edit-form">';
            echo '<h3 style="margin-top: 0;">Edit Temperature</h3>';
            echo '<div class="form-group">';
            echo '<label>Temperature (°C):</label>';
            echo '<input type="number" step="0.1" name="temp_celsius" value="' . $celsius . '" required>';
            echo '</div>';
            echo '<input type="hidden" name="section" value="temperature">';
            echo '<button type="submit" class="submit-btn">Convert</button>';
            echo '</form>';
        }
    ],
    'swap' => [
        'title' => 'Swapping Variables',
        'content' => function() {
            $a = 5;
            $b = 10;
            echo "Before Swap: a = $a, b = $b<br>";
            $temp = $a;
            $a = $b;
            $b = $temp;
            echo "After Swap: a = $a, b = $b<br>";
            $x = 15;
            $y = 20;
            echo "Alternative method (without temp variable):<br>";
            echo "Before: x = $x, y = $y<br>";
            list($x, $y) = array($y, $x);
            echo "After: x = $x, y = $y<br>";
        }
    ],
    'salary' => [
        'title' => 'Salary Calculator',
        'content' => function() {
            $basic_salary = isset($_POST['sal_basic']) ? floatval($_POST['sal_basic']) : 50000;
            $allowance = isset($_POST['sal_allowance']) ? floatval($_POST['sal_allowance']) : 10000;
            $deduction = isset($_POST['sal_deduction']) ? floatval($_POST['sal_deduction']) : 5000;
            $net_salary = $basic_salary + $allowance - $deduction;
            
            echo "Basic Salary: ₱" . number_format($basic_salary, 2) . "<br>";
            echo "Allowance: +₱" . number_format($allowance, 2) . "<br>";
            echo "Deduction: -₱" . number_format($deduction, 2) . "<br>";
            echo "Net Salary: ₱" . number_format($net_salary, 2) . "<br>";
            $net_increase = (($allowance - $deduction) / $basic_salary) * 100;
            echo "Net increase: " . number_format($net_increase, 2) . "%<br><br>";
            
            echo '<form method="POST" class="edit-form">';
            echo '<h3 style="margin-top: 0;">Edit Salary Details</h3>';
            echo '<div class="form-group">';
            echo '<label>Basic Salary (₱):</label>';
            echo '<input type="number" step="0.01" name="sal_basic" value="' . $basic_salary . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>Allowance (₱):</label>';
            echo '<input type="number" step="0.01" name="sal_allowance" value="' . $allowance . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>Deduction (₱):</label>';
            echo '<input type="number" step="0.01" name="sal_deduction" value="' . $deduction . '" required>';
            echo '</div>';
            echo '<input type="hidden" name="section" value="salary">';
            echo '<button type="submit" class="submit-btn">Calculate</button>';
            echo '</form>';
        }
    ],
    'bmi' => [
        'title' => 'BMI Calculator',
        'content' => function() {
            $weight = isset($_POST['bmi_weight']) ? floatval($_POST['bmi_weight']) : 68;
            $height = isset($_POST['bmi_height']) ? floatval($_POST['bmi_height']) : 1.61;
            $bmi = $weight / ($height * $height);
            
            echo "Given weight = $weight kg and height = $height m:<br>";
            echo "Your BMI is: " . number_format($bmi, 2) . "<br>";
            if ($bmi < 18.5) {
                echo "Category: Underweight<br><br>";
            } elseif ($bmi < 25) {
                echo "Category: Normal weight<br><br>";
            } elseif ($bmi < 30) {
                echo "Category: Overweight<br><br>";
            } else {
                echo "Category: Obese<br><br>";
            }
            
            echo '<form method="POST" class="edit-form">';
            echo '<h3 style="margin-top: 0;">Edit BMI Data</h3>';
            echo '<div class="form-group">';
            echo '<label>Weight (kg):</label>';
            echo '<input type="number" step="0.1" name="bmi_weight" value="' . $weight . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>Height (m):</label>';
            echo '<input type="number" step="0.01" name="bmi_height" value="' . $height . '" required>';
            echo '</div>';
            echo '<input type="hidden" name="section" value="bmi">';
            echo '<button type="submit" class="submit-btn">Calculate BMI</button>';
            echo '</form>';
        }
    ],
    'string' => [
        'title' => 'String Manipulation',
        'content' => function() {
            $sentence = isset($_POST['str_sentence']) ? htmlspecialchars($_POST['str_sentence']) : "Hello, how are you?";
            
            echo "Sentence: \"$sentence\"<br>";
            echo "Number of characters: " . strlen($sentence) . "<br>";
            echo "Number of words: " . str_word_count($sentence) . "<br>";
            echo "Uppercase: " . strtoupper($sentence) . "<br>";
            echo "Lowercase: " . strtolower($sentence) . "<br>";
            echo "Reversed: " . strrev($sentence) . "<br>";
            echo "First word: " . strtok($sentence, " ") . "<br>";
            echo "Replace 'Hello' with 'Hi': " . str_replace("Hello", "Hi", $sentence) . "<br><br>";
            
            echo '<form method="POST" class="edit-form">';
            echo '<h3 style="margin-top: 0;">Edit String</h3>';
            echo '<div class="form-group">';
            echo '<label>Enter a sentence:</label>';
            echo '<input type="text" name="str_sentence" value="' . $sentence . '" required>';
            echo '</div>';
            echo '<input type="hidden" name="section" value="string">';
            echo '<button type="submit" class="submit-btn">Process String</button>';
            echo '</form>';
        }
    ],
    'bank' => [
        'title' => 'Bank Account Simulation',
        'content' => function() {
            $balance = isset($_POST['bank_balance']) ? floatval($_POST['bank_balance']) : 1000;
            $deposit = isset($_POST['bank_deposit']) ? floatval($_POST['bank_deposit']) : 200;
            $withdraw = isset($_POST['bank_withdraw']) ? floatval($_POST['bank_withdraw']) : 150;
            
            echo "Initial balance: ₱" . number_format($balance, 2) . "<br>";
            echo "Depositing: +₱" . number_format($deposit, 2) . "<br>";
            $balance += $deposit;
            echo "Balance after deposit: ₱" . number_format($balance, 2) . "<br>";
            echo "Withdrawing: -₱" . number_format($withdraw, 2) . "<br>";
            $balance -= $withdraw;
            echo "Final Balance: ₱" . number_format($balance, 2) . "<br>";
            if ($balance > 0) {
                echo "Status: Account in good standing ✓<br><br>";
            } else {
                echo "Status: Overdrawn! ✗<br><br>";
            }
            
            echo '<form method="POST" class="edit-form">';
            echo '<h3 style="margin-top: 0;">Edit Bank Transaction</h3>';
            echo '<div class="form-group">';
            echo '<label>Initial Balance (₱):</label>';
            echo '<input type="number" step="0.01" name="bank_balance" value="' . (isset($_POST['bank_balance']) ? $_POST['bank_balance'] : 1000) . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>Deposit Amount (₱):</label>';
            echo '<input type="number" step="0.01" name="bank_deposit" value="' . (isset($_POST['bank_deposit']) ? $_POST['bank_deposit'] : 200) . '" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label>Withdraw Amount (₱):</label>';
            echo '<input type="number" step="0.01" name="bank_withdraw" value="' . (isset($_POST['bank_withdraw']) ? $_POST['bank_withdraw'] : 150) . '" required>';
            echo '</div>';
            echo '<input type="hidden" name="section" value="bank">';
            echo '<button type="submit" class="submit-btn">Simulate Transaction</button>';
            echo '</form>';
        }
    ]
];
?>

<div class="buttons">
    <form method="POST" style="display: inline;">
        <?php foreach ($sections as $key => $section): ?>
            <button type="submit" name="section" value="<?php echo $key; ?>" 
                    class="<?php echo ($current_section === $key) ? 'active' : ''; ?>">
                <?php echo $section['title']; ?>
            </button>
        <?php endforeach; ?>
    </form>
</div>

<div class="content">
    <?php if (isset($sections[$current_section])): ?>
        <h2><?php echo $sections[$current_section]['title']; ?></h2>
        <?php $sections[$current_section]['content'](); ?>
    <?php else: ?>
        <p>Section not found. Please select a valid section.</p>
    <?php endif; ?>
</div>
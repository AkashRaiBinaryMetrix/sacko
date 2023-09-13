<?php
// Define your credit card debts
$debts = [
    ['name' => 'Card A', 'balance' => 100000, 'interest_rate' => 5],
];

// Function to calculate monthly payment
function calculateMonthlyPayment($balance, $interestRate, $monthlyPayment) {
    $monthlyInterest = $balance * ($interestRate / 12);
    $principalPayment = $monthlyPayment - $monthlyInterest;
    $newBalance = $balance - $principalPayment;
    
    return [
        'monthlyInterest' => $monthlyInterest,
        'principalPayment' => $principalPayment,
        'newBalance' => $newBalance,
    ];
}

// Function to calculate snowball payment schedule
function calculateSnowballSchedule($debts, $monthlyPayment) {
    $schedule = [];
    
    while (array_sum(array_column($debts, 'balance')) > 0) {
        foreach ($debts as $key => $debt) {
            if ($debt['balance'] > 0) {
                $paymentDetails = calculateMonthlyPayment($debt['balance'], $debt['interest_rate'], $monthlyPayment);
                $debts[$key]['balance'] = $paymentDetails['newBalance'];
                
                $schedule[] = [
                    'name' => $debt['name'],
                    'monthlyInterest' => $paymentDetails['monthlyInterest'],
                    'principalPayment' => $paymentDetails['principalPayment'],
                    'newBalance' => $paymentDetails['newBalance'],
                ];
            }
        }
    }
    
    return $schedule;
}

// Define your fixed monthly payment
$monthlyPayment = 1500;

// Calculate the snowball payment schedule
$snowballSchedule = calculateSnowballSchedule($debts, $monthlyPayment);

// Display the snowball payment schedule
echo "<table>";
echo "<tr><th>Card Name</th><th>Monthly Interest</th><th>Principal Payment</th><th>New Balance</th></tr>";
foreach ($snowballSchedule as $entry) {
    echo "<tr>";
    echo "<td>{$entry['name']}</td>";
    echo "<td>{$entry['monthlyInterest']}</td>";
    echo "<td>{$entry['principalPayment']}</td>";
    echo "<td>{$entry['newBalance']}</td>";
    echo "</tr>";
}
echo "</table>";
?>
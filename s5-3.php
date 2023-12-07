<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор</title>
</head>
<body>
    <form method="POST" name="calculator">
        Введите число: <input type="text" name="number" value="<?php echo isset($_POST['number']) ? $_POST['number'] : ''; ?>">
        
        <input type="hidden" name="operation" value="<?php echo isset($_POST['operation']) ? $_POST['operation'] : ''; ?>">

        Выберите операцию:
        <select name="operation">
            <option value="even" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'even') echo 'selected'; ?>>Четные делители</option>
            <option value="odd" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'odd') echo 'selected'; ?>>Нечетные делители</option>
            <option value="prime" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'prime') echo 'selected'; ?>>Простые делители</option>
            <option value="composite" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'composite') echo 'selected'; ?>>Составные делители</option>
            <option value="all" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'all') echo 'selected'; ?>>Все делители</option>
        </select>

        <input type="submit" value="Считать">
    </form>

    <?php
    if (isset($_POST['number'])) {
        $N = intval($_POST['number']);
    } else { $N = 0; }

    if (isset($_POST['operation'])) {
        $operation = $_POST['operation'];
    } else { $operation = ''; }

    if (isset($N) && $N > 0 && !empty($operation)) {
        $divisors = getDivisors($N, $operation);

        echo "Делители для $N ($operation): " . implode(", ", $divisors);
    }

    // Функция для определения простоты числа
    function isPrime($number) {
        if ($number < 2) {
            return false;
        }
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                return false;
            }
        }
        return true;
    }

    // Функция для получения делителей числа N, в зависимости от выбранной операции
    function getDivisors($N, $operation) {
        $divisors = array();

        if ($operation == 'even') {
            // Четные делители
            for ($i = 2; $i <= $N; $i+=2) {
                if ($N % $i == 0) {
                    $divisors[] = $i;
                }
            }
        } elseif ($operation == 'odd') {
            // Нечетные делители
            for ($i = 1; $i <= $N; $i+=2) {
                if ($N % $i == 0) {
                    $divisors[] = $i;
                }
            }
        } elseif ($operation == 'prime') {
            // Простые делители
            $divisors[] = 1; 
            for ($i = 1; $i <= $N; $i++) {
                if ($N % $i == 0 && isPrime($i)) {
                    $divisors[] = $i;
                }
            }
        } elseif ($operation == 'composite') {
            // Составные делители
            for ($i = 2; $i <= $N; $i++) {
                if ($N % $i == 0 && !isPrime($i)) {
                    $divisors[] = $i;
                }
            }
        } elseif ($operation == 'all') {
            // Все делители
            for ($i = 1; $i <= $N; $i++) {
                if ($N % $i == 0) {
                    $divisors[] = $i;
                }
            }
        }
        return $divisors;
    }
    ?>
</body>
</html>
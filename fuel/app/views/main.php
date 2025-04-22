<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?= \Asset::css('main.css'); ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js'></script>

</head>
<body>

    <a class="register" href="/register">+</a>


    <a class="logout" href="/auth/logout">ログアウト</a>

    
    <button data-bind="click: previousDay">前日</button>

    <input type="date" data-bind="value: inputDate">

    <button data-bind="click: followingDay">翌日</button>

    <div data-bind="visible: isLoading"">
        <p >ロード中...</p>
    </div>


    <br>
    <br>

    <span class="date" data-bind="text: outputDate"></span>

    <div data-bind="foreach: transactions">
        <div class="transaction">
            <p class="money"><span data-bind="text: category"></span> : <span data-bind="text: amount"></span>円</p>

            <div class="editor">
                <form method="GET" action="/register/edit">
                    <input type="hidden" name="edit" data-bind="attr: { value: id }">
                    <button type="submit">編集する</button>
                </form>

                <form method="GET" action="/register/delete">
                    <input type="hidden" name="delete" data-bind="attr: { value: id }">
                    <button type="submit">削除する</button>
                </form>
            </div>

            <p class="memo">メモ : <span data-bind="text: description"></span></p>

        </div>
    </div>



    <script>

        // --- Knockout.js ViewModel 定義 ---
        function DateViewModel() {
            var self = this;

            var transactions = <?php echo json_encode($transactions); ?>;

            self.inputDate = ko.observable('<?php echo $original; ?>');
            self.outputDate = ko.observable('<?php echo $formatted; ?>');
            self.transactions = ko.observableArray(transactions);
            self.isLoading = ko.observable(false);

            self.inputDate.subscribe(function(newDateValue) {
                self.updateDateOnServer('update');
            });
            self.previousDay = function() {
                self.updateDateOnServer('previous');
            };
            self.followingDay = function() {
                self.updateDateOnServer('following');
            };

            self.updateDateOnServer = function(operation) {
                var baseDate = self.inputDate();
                self.isLoading(true);
                var ajaxUrl = '<?php echo Uri::create("main/calendar"); ?>';

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        date: baseDate,
                        operation: operation
                    },

                    success: function(response) {
                        self.outputDate(response.formatted);
                        self.transactions(response.transactions);
                        self.inputDate(response.original);
                    },
                    error: function() {
                        self.outputDate('エラー');
                    },
                    complete: function() {
                        self.isLoading(false);
                    }
                });
            }
        }

        $(document).ready(function() {
            ko.applyBindings(new DateViewModel());
        });
    </script>

</body>
</html>
<!-- Invalid login page -->
<div class="card mx-auto" style="width: 18rem;">
                    <form class="pt-3" action="./?action=ValidLogin" method="post">
                        <h1>Login</h1>
                        <h2>Email</h2>
                        <input type="text" name="Email" id="emailInput" placeholder=" ... " required>
                        <h2>API Key</h2>
                        <input type="text" name="Apikey" id="apiKeyInput" placeholder=" ... " required>

                        <?php

                            echo '<p style="color: red;">Invalid Login!</p>';

                        ?>

                        <button type="submit">Login</button>
                    </form>
                </div>
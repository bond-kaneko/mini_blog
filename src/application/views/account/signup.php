<?php $this->setLayoutVar('title', 'アカウント登録') ?>

<h2>アカウント登録</h2>

<form action="<?= $base_url; ?>/account/register" method="post">
    <input type="hidden" name="_token" value="<?= $this->escape($_token); ?>" />

    <?php if (isset($errors) && count($errors) > 0) : ?>
        <ul class="error_list">
            <?php foreach ($errors as $error) : ?>
                <li><?= $this->escape($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <table>
        <tbody>
            <tr>
                <th>ユーザーID</th>
                <td>
                    <input type="text" name="user_name" value="<?= $this->escape($user_name) ?>" />
                </td>
            </tr>
            <tr>
                <th>パスワード</th>
                <td>
                    <input type="passwod" name="password" value="<?= $this->escape($password) ?>" />
                </td>
            </tr>
        </tbody>
    </table>

    <p>
        <input type="submit" value="登録" />
    </p>
</form>
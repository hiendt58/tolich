<?php
if (is_active_sidebar('main-sidebar')) {
dynamic_sidebar('main-sidebar');
} else {
_e('Đây là vùng hiển thị widget. Truy cập Appearance -> Widgets để thêm các widget mới.', 'tolich');
}
?>
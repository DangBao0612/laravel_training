CREATE DATABASE mvc_blog
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE mvc_blog;

/* USERS */
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY, -- Auto Increment để id tăng liên tục, đảm bảo không trùng lặp
  email VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  remember_token VARCHAR(64), -- Taoken ghi nhớ đăng nhập. NULL nếu user ko tick
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Ghi thời điểm tạo record
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
             ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB; -- Chọn engine InnoDB

/* POSTS */
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY, -- Khóa chính của Post
  user_id INT UNSIGNED NOT NULL, -- Khóa ngoại trỏ đến user.id
  title VARCHAR(255) NOT NULL, -- Tiêu đề
  content TEXT NOT NULL, -- Nội dung
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
             ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_user   (user_id), -- Tạo một INDEX trên cột user_id, tăng tốc truy vấn
  CONSTRAINT fk_posts_user
      FOREIGN KEY (user_id) -- Định nghĩa khóa ngoại, đảm bảo mỗi khóa ngoại user_id ở bảng Posts đều phải tồn tại ở bảng Users
      REFERENCES users(id)
      ON DELETE CASCADE -- Nếu xóa 1 user, InnoDB sẽ xóa toàn bộ dữ liệu của người đó
) ENGINE=InnoDB;


/* TEST DATA */
USE mvc_blog;                   

-- USERS 
INSERT INTO users (email, password_hash, remember_token)
VALUES
 ('jack@gmail.com', '$2y$10$sFXFGKOCOopx2cCR6ZxyW.TQp6MflFAfaQ1J7E6ikA0RG7kEDeN7a', NULL), -- hi123
 ('john@gmail.com',   '$2y$10$rDsvBBkZk/wevXkEWYfBo.ezlonqXwDOhGNz8beCBtMFQKnuTB7by', NULL);-- hello123

-- POSTS 
INSERT INTO posts (user_id, title, content)
VALUES
 (1, 'Hello world',        'Đây là bài viết đầu tiên của Jack'),
 (1, 'Hướng dẫn MVC',      'Chi tiết cách chia tầng MVC cho PHP mini project'),
 (2, 'Xin chào',           'John vừa gia nhập blog'),
 (2, 'Note ngắn',          'Test post thứ hai của John');

SELECT * FROM users;
SELECT id, title, user_id FROM posts ORDER BY id;

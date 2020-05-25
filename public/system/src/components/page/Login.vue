<template>
    <div class="login-wrap">
        <div class="ms-login">
            <div class="ms-title">登陆</div>
            <el-form :model="param" :rules="rules" ref="login" label-width="0px" class="ms-content">
                <el-form-item prop="username">
                    <el-input v-model="param.username" placeholder="账户名称">
                        <!-- <el-button slot="prepend" icon="el-icon-lx-people"></el-button> -->
                    </el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input type="password" placeholder="账号密码" v-model="param.password" @keyup.enter.native="submitForm()">
                        <!-- <el-button slot="prepend" icon="el-icon-lx-lock"></el-button> -->
                    </el-input>
                </el-form-item>
                <div class="login-btn">
                    <el-button type="primary" @click.prevent="submitForm()">登录</el-button>
                </div>
                <p class="login-tips">Tips : 没有账户请找管理员</p>
            </el-form>
        </div>
    </div>
</template>

<script>
import { Login } from '../../api/login';

export default {
    data: function() {
        return {
            param: {
                username: '',
                password: ''
            },
            rules: {
                username: [{ required: true, message: '请输入用户名', trigger: 'blur' }],
                password: [{ required: true, message: '请输入密码', trigger: 'blur' }]
            }
        };
    },
    methods: {
        submitForm() {
            console.log(this);
            this.$refs.login.validate(valid => {
                if (valid) {
                    Login(this.param).then(res => {
                        if (res.code === '0') {
                            this.$message.success('登录成功');
                            localStorage.setItem('ms_username', this.param.username);
                            this.$router.push('/');
                        } else {
                             this.$message.error(res.msg);
                        }
                    });
                } else {
                    this.$message.error('请输入账号和密码');
                    console.log('error submit!!');
                    return false;
                }
            });
        }
    }
};
</script>

<style scoped>
.login-wrap {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: linear-gradient(135deg, #ee9ae5 10%, #5961f9 100%);
    user-select: none;
}

.ms-title {
    display: none;
    width: 100%;
    padding: 12px 0;
    text-align: center;
    font-size: 18px;
    font-weight: 300;
    color: #fff;
    letter-spacing: 2px;
    border-bottom: 1px solid #e2e2e2;
}
.ms-login {
    width: 350px;
    height: 300px;
    border-radius: 4px;
    /* background: rgba(255, 255, 255, 0.3); */
    /* overflow: hidden; */
}
.ms-content {
    padding: 30px 30px;
}

.el-form-item--mini.el-form-item,
.el-form-item--small.el-form-item {
    margin-bottom: 35px;
}
.login-btn {
    text-align: center;
}
.login-btn button {
    width: 100%;
    height: 36px;
    font-size: 14px;
    letter-spacing: 2px;
    margin-bottom: 10px;
}
.login-tips {
    display: none;
    font-size: 12px;
    line-height: 30px;
    color: red;
}
</style>

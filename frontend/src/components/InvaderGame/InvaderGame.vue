<script setup lang="ts">
import BaseBtn from '@/components/Common/BaseBtn/BaseBtn.vue';
import BaseStack from '@/components/Common/BaseStack/BaseStack.vue';
import BaseIcon from '../Common/BaseIcon/BaseIcon.vue';

interface EnemyType {
  x: number;
  y: number;
  width: number;
  height: number;
  color: string;
  dx: number;
}

interface EnemyBulletType {
  x: number;
  y: number;
  width: number;
  height: number;
  speed: number;
}


const canvasRef = useTemplateRef('canvas');

const player = {
  x: 320 / 2 - 15,
  y: 320 - 30,
  width: 30,
  height: 15,
  color: 'white',
  speed: 10
};

const bullets: {
  x: number;
  y: number;
  width: number;
  height: number;
}[] = [];

const enemies: EnemyType[] = [];
const enemyBullets: EnemyBulletType[] = [];
const bulletSpeed = 5;
const isGameOver = ref(false);
const isGameClear = ref(false);


const context = computed(() => {
  return canvasRef.value?.getContext("2d");
})

function onClickRight() {
  moveRight()
}

function onClickLeft() {
  moveLeft()
}

function onFire() {
  fire();
}

function drawPlayer() {
  const ctx = context.value;
  if (!ctx) return;
  const { x, y, width, height } = player;

  ctx.fillStyle = 'white';
  ctx.beginPath();

  // 左から描いていく
  ctx.moveTo(x, y + height); // 左下
  ctx.quadraticCurveTo(x, y, x + width * 0.2, y); // 左カーブ
  ctx.lineTo(x + width * 0.45, y); // 中央左
  ctx.lineTo(x + width * 0.5, y - height * 0.5); // 中央突起（上へ）
  ctx.lineTo(x + width * 0.55, y); // 中央右
  ctx.lineTo(x + width * 0.8, y); // 右へ
  ctx.quadraticCurveTo(x + width, y, x + width, y + height); // 右カーブ
  ctx.closePath();
  ctx.fill();
}

function drawBullets() {
  if (!context.value) return;
  context.value.fillStyle = 'white';
  bullets.forEach(bullet => {
    context.value?.fillRect(bullet.x, bullet.y, bullet.width, bullet.height);
  });
}
function drawPixelEnemy(enemy: EnemyType) {
  const context = canvasRef.value?.getContext('2d')
  const pixelSize = 5;
  const sprite = [
    '00100',
    '01110',
    '11111',
    '10101',
    '00100',
    '01010'
  ];
  if (!context) return

  context.fillStyle = enemy.color;

  for (let row = 0; row < sprite.length; row++) {
    // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
    for (let col = 0; col < sprite[row]!.length; col++) {
      // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
      if (sprite[row]![col] === '1') {
        context.fillRect(
          enemy.x + col * pixelSize,
          enemy.y + row * pixelSize,
          pixelSize,
          pixelSize
        );
      }
    }
  }
}

function drawEnemies() {
  for (const enemy of enemies) {
    drawPixelEnemy(enemy)
  }
}

function updateEnemies() {
  for (const enemy of enemies) {
    enemy.x += enemy.dx;

    if (enemy.x <= 0 || enemy.x + enemy.width >= (canvasRef.value?.width ?? 320)) {
      enemy.dx *= -1;
      break;
    }
  }
}

function createEnemies(rows: number, cols: number) {
  const padding = 15;
  const offsetX = 30;
  const offsetY = 30;
  const width = 20;
  const height = 20;

  for (let row = 0; row < rows; row++) {
    for (let col = 0; col < cols; col++) {
      enemies.push({
        x: offsetX + col * (width + padding),
        y: offsetY + row * (height + padding),
        width,
        height,
        color: 'green',
        dx: 1
      });
    }
  }
}

function enemyShoot() {
  if (enemies.length === 0) return;

  const shooter = enemies[Math.floor(Math.random() * enemies.length)];
  if (shooter) {
    enemyBullets.push({
      x: shooter.x + shooter.width / 2 - 2,
      y: shooter.y + shooter.height,
      width: 4,
      height: 10,
      speed: 3
    });
  }
}

function updateEnemyBullets() {
  for (let i = enemyBullets.length - 1; i >= 0; i--) {
    const bullet = enemyBullets[i]
    if (bullet) {
      bullet.y += bullet.speed;

      // 画面外に出たら消す
      if (bullet.y > (canvasRef.value?.height ?? 320)) {
        enemyBullets.splice(i, 1);
      }
    }
  }
}

function drawEnemyBullets() {
  const ctx = context.value
  if (ctx) {
    ctx.fillStyle = 'red';
    for (const bullet of enemyBullets) {
      ctx.fillRect(bullet.x, bullet.y, bullet.width, bullet.height);
    }
  }
}

function updateBullets() {
  for (let i = bullets.length - 1; i >= 0; i--) {
    const bullet = bullets[i];
    if (bullet) {
      bullet.y -= bulletSpeed;
      if (bullet.y + bullet.height < 0) {
        bullets.splice(i, 1);
      }
    }
  }
}

function moveRight() {
  if (!canvasRef.value) return
  player.x = Math.min(canvasRef.value.width - player.width, player.x + player.speed);
  drawPlayer();
}

function moveLeft() {
  if (!canvasRef.value) return
  player.x = Math.min(canvasRef.value.width - player.width, player.x - player.speed);
  drawPlayer();
  drawBullets()
}

function fire() {
  bullets.push({
    x: player.x + player.width / 2 - 2,
    y: player.y,
    width: 4,
    height: 10
  });
}

function checkCollisions() {
  for (let i = bullets.length - 1; i >= 0; i--) {
    const bullet = bullets[i];

    for (let j = enemies.length - 1; j >= 0; j--) {
      const enemy = enemies[j];
      if (bullet && enemy) {
        const hit =
          bullet.x < enemy.x + enemy.width &&
          bullet.x + bullet.width > enemy.x &&
          bullet.y < enemy.y + enemy.height &&
          bullet.y + bullet.height > enemy.y;

        if (hit) {
          bullets.splice(i, 1);
          enemies.splice(j, 1);
          break;
        }
      }
    }
  }
}

function checkPlayerHit() {
  for (const bullet of enemyBullets) {
    const hit =
      bullet.x < player.x + player.width &&
      bullet.x + bullet.width > player.x &&
      bullet.y < player.y + player.height &&
      bullet.y + bullet.height > player.y;

    if (hit) {
      isGameOver.value = true;
      break;
    }
  }
}

function checkClear() {
  if (enemies.length === 0 && !isGameClear.value && !isGameOver.value) {
    isGameClear.value = true;
  }
}

function drawGameOver() {
  const ctx = context.value
  if (!ctx) {
    return
  }
  ctx.fillStyle = 'black';
  ctx.fillRect(0, 0, 320, 320);

  ctx.fillStyle = 'white';
  ctx.font = '40px sans-serif';
  ctx.textAlign = 'center';
  ctx.fillText('GAME OVER', 320 / 2, 320 / 2);
}

function drawGameClear() {
  const ctx = context.value
  const width = 320
  const height = 320
  if (!ctx) {
    return
  }
  ctx.fillStyle = '#6FBF90';
  ctx.fillRect(0, 0, width, height);

  ctx.fillStyle = 'white';
  ctx.font = '40px sans-serif';
  ctx.textAlign = 'center';
  ctx.fillText('GAME CLEAR!!', 320 / 2, 320 / 2);
}

function gameLoop() {
  if (isGameOver.value) {
    drawGameOver()
    return;
  }

  if (isGameClear.value) {
    drawGameClear()
    return;
  }

  context.value?.clearRect(0, 0, canvasRef.value?.width ?? 320, canvasRef.value?.height ?? 320);
  updateBullets();
  updateEnemies();
  updateEnemyBullets();
  checkCollisions();
  checkPlayerHit();
  checkClear();

  drawPlayer();
  drawBullets();
  drawEnemies();
  drawEnemyBullets();
  requestAnimationFrame(gameLoop);
}

function enemiesAttack() {
  const interval = Math.floor(Math.random() * (900 - 100 + 1)) + 100;
  setInterval(enemyShoot, interval);
}

function start() {
  createEnemies(2, 8);
  gameLoop()
  enemiesAttack()
}

function resetGame() {
  player.x = (canvasRef.value?.width ?? 320) / 2 - 20;
  player.y = (canvasRef.value?.height ?? 320) - 30;

  bullets.length = 0;
  enemyBullets.length = 0;
  enemies.length = 0;
  createEnemies(2, 8);


  isGameOver.value = false;
  isGameClear.value = false;
  requestAnimationFrame(gameLoop);
}


onMounted(() => {
  start();
})

</script>

<template>
  <BaseStack
    class="items-center justify-between"
    component="div"
    gap="md"
    grow
  >
    <canvas
      ref="canvas"
      class="bg-primary"
      height="320"
      width="320"
    />

    <BaseStack
      :col="false"
      component="div"
      gap="xl"
    >
      <template v-if="!isGameOver && !isGameClear">
        <BaseBtn
          class="w-22"
          size="lg"
          variant="outline"
          @click="onClickLeft"
        >
          <BaseIcon icon="chevron_left" />
        </BaseBtn>

        <BaseBtn
          class="w-22"
          size="lg"
          variant="outline"
          @click="onFire"
        >
          fire
        </BaseBtn>

        <BaseBtn
          class="w-22"
          size="lg"
          variant="outline"
          @click="onClickRight"
        >
          <BaseIcon icon="chevron_right" />
        </BaseBtn>
      </template>
      <BaseBtn
        v-else
        size="lg"
        variant="outline"
        @click="resetGame"
      >
        もう一度遊ぶ
      </BaseBtn>
    </BaseStack>
  </BaseStack>
</template>
<style scoped>
button {
  touch-action: manipulation;
}
</style>

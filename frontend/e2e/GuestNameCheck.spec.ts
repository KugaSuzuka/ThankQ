import { test, expect } from '@playwright/test';
import fs from 'fs';
const rawData = fs.readFileSync('./e2e/fixtures/guests.json', 'utf-8');
const guests = JSON.parse(rawData) as { name: string, url: string }[];

for (const guest of guests) {
  test(`URLと${guest.name}が一致していること`, async ({ page }) => {
    await page.goto(guest.url);

    try {
      await expect(page.getByText(guest.name)).toBeVisible();
    } catch (error) {
      await page.screenshot({ path: `e2e/screenshots/${guest.name}.png` });
      throw error;
    }
  });
}
